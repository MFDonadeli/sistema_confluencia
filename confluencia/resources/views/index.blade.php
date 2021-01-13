<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <link href="{{ asset('css/index_styles.css') }}" rel="stylesheet">
    </head>

    <body>
        <div id="header">
            Moeda Atual: <strong><span id='moeda'>EURUSD</span></strong>
            Origem: 
            <button class='btn_src btn_active' id='btn_mt4'>MT4</button>
            <button class='btn_src' id='btn_iq'>IqOption</button>
            <input type="hidden" name="id_moeda" id="id_moeda" value="1">
        </div>

        <div id='content-panel'>
            <div id='left-panel'>
                <ul>
    @foreach ($pairs as $pair)
                    <li>
                        <button id='pair_{{$pair->idpairs}}' class='botao_moeda'> {{$pair->pair}} </button>
                    </li>   
    @endforeach
                </ul>
            </div> <!-- left-panel -->
            <div id='main-panel'>
                
                <div class='result flex-container' id='result-container'>
                    
                </div> <!-- result-container -->
                
                <p>Confluencia próxima vela: <span id='moeda_msg'></span></p>

                <div class='flex-container' id='estrategia-container'>
                @foreach ($estrategias as $est)
                <div class='result-half'>
                    <h3>{{$est->estrategia}}</h3>
                    <p id='{{$est->alias}}_msg'></p>
                    <div class='flex-container' id='content-{{$est->alias}}'>
                    </div>
                </div>    
                @endforeach
                </div> <!-- estrategia-container -->
            </div> <!-- main-panel -->
        </div> <!-- content-panel -->

        <script>
            setTimeout(run_ajax, 60 * 1000);

            function run_ajax(){

                const source = $('#btn_mt4').hasClass('btn_active') ? 'mt4' : 'iq';
                const moeda = $('#id_moeda').val();

                $.getJSON('/resultado-data/' + source + "/" + moeda,
                    function(data) {
                        $.each(data, function(div_id, code){
                            $('#'+div_id).html(code);
                        });
                        
                    });

                $.ajax({
                    url: '/candles-data/' + source + "/" + moeda
                }).done(function(data) {
                    $("#result-container").html(data);
                });
            }

            $('.botao_moeda').click(function() {
                console.log();
                var btn_id = $(this).attr('id');
                btn_id = btn_id.replace('pair_', '');
                $('#moeda').html($(this)[0].innerText);
                $('#id_moeda').val(btn_id);

                run_ajax();
            });

            $('.btn_src').click(function() {
                $('#btn_mt4').toggleClass('btn_active');
                $('#btn_iq').toggleClass('btn_active');

                run_ajax();
            });
        </script>
    </body>
</html>