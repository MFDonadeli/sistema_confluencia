from iqoptionapi.stable_api import IQ_Option
import mysql.connector
from mysql.connector import Error

import time, json
from datetime import datetime
from dateutil import tz

import asyncio
import aiohttp
import logging

logging.basicConfig(filename='myapp.log', level=logging.INFO)

API = IQ_Option('mfdonadeli@gmail.com','43EOUo1*DYYS')
API.connect()

time.sleep(1)

last_time_processed = ''

def timestamp_converter(x, datahora="datahora"):
    hora = datetime.strptime(datetime.utcfromtimestamp(x).strftime('%Y-%m-%d %H:%M:%S'), '%Y-%m-%d %H:%M:%S')
    hora = hora.replace(tzinfo=tz.gettz('GMT'))
    hr = hora.astimezone(tz.gettz('America/Sao Paulo'))

    if datahora=="datahora":
        return hr.strftime('%Y-%m-%d %H:%M')
    elif datahora=="data":
        return hr.strftime('%Y-%m-%d')
    elif datahora=="hora":
        return hr.strftime('%H:%M')
    elif datahora=="dthr":
        return hr.strftime('%Y%m%d%H%M')

    return str(hora.astimezone(tz.gettz('America/Sao Paulo')).strftime('%Y-%m-%d'))[:-6]

def payout(par, tipo):
    logging.info("Entrando para pegar payout de " + par + " do tipo " + tipo)

    if tipo == 'turbo':
        a = API.get_all_profit()
        try:
            b = int(100 * a[par]['turbo'])
        except Error:
            return 0

        return b
    elif tipo == 'digital':
        try:
            API.subscribe_strike_list(par, 1)
            while True:
                d = API.get_digital_current_profit(par, 1)
                if d != False:
                    d = int(d)
                    break
                time.sleep(1)
            API.unsubscribe_strike_list(par, 1)
            return d
        except:
            print("Error")
            return 0

def log_iq():
    logging.info("Entrando para gravar estado atual no bd")
    values = ""
    for paridade in pares['turbo']:
        if pares['turbo'][paridade]['open'] == True:
            values += "('" + paridade + "','" + str(payout(paridade, 'turbo')) + "','Open','binario'),"
        elif pares['turbo'][paridade]['open'] == False:
            values += "('" + paridade + "','0','Closed','binario'),"

    for paridade in pares['digital']:
        if pares['digital'][paridade]['open'] == True:
            values += "('" + paridade + "','" + str(payout(paridade, 'digital')) + "','Open','digital'),"
        elif pares['digital'][paridade]['open'] == False:
            values += "('" + paridade + "','0','Closed','digital'),"   

    values = values[:-1]   
    try:
        connection = mysql.connector.connect(host='localhost',
                                            database='iq',
                                            user='root',
                                            password='')
        mySql_insert_query = "REPLACE INTO pairs_iq_option_states (pair, payout, open, type) " \
                            + "VALUES " + values

        cursor = connection.cursor()
        cursor.execute(mySql_insert_query)
        connection.commit()
        print(cursor.rowcount, "Record inserted successfully into Laptop table")
        cursor.close()

    except mysql.connector.Error as error:
        print("Failed to insert record into Laptop table {}".format(error))

    finally:
        if (connection.is_connected()):
            connection.close()
            print("MySQL connection is closed")           

def get_all_pairs():
    logging.info("Pegando todos os pares no BD")
    try:
        connection = mysql.connector.connect(host='localhost',
                                            database='iq',
                                            user='root',
                                            password='')
        if connection.is_connected():
            db_Info = connection.get_server_info()
            print("Connected to MySQL Server version ", db_Info)
            cursor = connection.cursor()
            cursor.execute("select * from pairs;")
            record = cursor.fetchall()
            

    except Error as e:
        print("Error while connecting to MySQL", e)
    finally:
        if (connection.is_connected()):
            cursor.close()
            connection.close()
            print("MySQL connection is closed")

    return record  

async def main(candle_dthr):
    async with aiohttp.ClientSession() as session:
        url = "http://localhost:8000/start-import/iq/" + candle_dthr
        print(url)
        async with session.get(url) as response:
            print("Status:", response.status)
            print("Content-type:", response.headers['content-type'])

            html = await response.text()
            print("Body:", html[:15], "...")      

while True:
    pares = API.get_all_open_time()
    pares_db = get_all_pairs()


    for par_db in pares_db:
        print(par_db[1] + " codigo " + str(par_db[0]))
        if pares['digital'][par_db[1]]['open'] == True or pares['turbo'][par_db[1]]['open'] == True :
            velas = API.get_candles(par_db[1], 60, 100, time.time()-60)
            if velas == None:
                continue
            values = ''
            logging.info("Pegou velas de " + par_db[1])
            
            last_candle = ''
            for vela in velas:
                last_candle = timestamp_converter(vela['from'],"dthr")
                if vela['open'] > vela['close']:
                    resultado_vela = "RED"
                elif vela['open'] < vela['close']:
                    resultado_vela = "GREEN"
                else:
                    resultado_vela = "GRAY"

                values = values + str(par_db[0])+","+ timestamp_converter(vela['from'],"data") + "," \
                    + timestamp_converter(vela['from'],"hora") + "," + timestamp_converter(vela['from'],"dthr") + "," \
                    + str(vela['open']) + "," + str(vela['close']) + "," + str(vela['min']) + "," \
                    + str(vela['max']) + "," + resultado_vela + "\n"

            f = open(par_db[1]+".txt", "w+")
            f.write(values)
            f.close()
            logging.info("Escreveu velas no arquivo")

    log_iq()

    print(last_candle)
    print(last_time_processed)

    if last_candle != last_time_processed:
        logging.info("Vai enviar...")
        loop = asyncio.get_event_loop()
        loop.run_until_complete(main(last_candle))  
        last_time_processed = last_candle
             
            #time.sleep(1)
         
    
    
    time.sleep(10)      
    
    

    

    


       

