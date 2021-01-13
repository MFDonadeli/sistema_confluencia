@foreach($candles as $candle)
    <div class='resultado res_{{strtolower($candle->resultado)}}'>{{$candle->hora}}</div>
@endforeach


