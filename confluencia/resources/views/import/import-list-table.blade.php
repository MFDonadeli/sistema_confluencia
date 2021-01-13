<table border=1>
    <tr>
        <th>PAIR</th>
        <th>Last Run</th>
    </tr>
    @foreach($table_content as $pair => $result)
    <tr>
        <td>{{$pair}}</td>
        <td>{{$result}}</td>
    </tr>
    @endforeach
</table>