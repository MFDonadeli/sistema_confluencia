@if (count($resultados) == 0) 
    <h2>Sem Resultados Para Mostrar</h2>
@else
    @foreach($resultados as $list_results)
    <div class='resultado res_{{strtolower($list_results->resultado_estrategia)}}'>
        {{substr($list_results->datahora,8)}}
    </div>
    @endforeach
@endif



