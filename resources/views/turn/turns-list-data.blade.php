@foreach($turns as $turn)
    <tr id = "{{ $turn->id}}">
        <td >{{ @$turn->classroomName}}</td>
        <td >{{ @$turn->day }}</td>
        <td >{{ @$turn->beginHour }}</td>
        <td >{{ @$turn->endHour }}</td>
        <td >{{ @$turn->subject_id}}</td>
        <td>
            <a href=" {{ action('TurnController@edit', ['id' => $turn->id]) }} "> 
                <i class="fas fa-edit"></i> 
            </a> 
        </td>
        <td> 
            <a href=" {{ action('TurnController@delete', ['id' => $turn->id]) }} "> 
                <i class="fas fa-trash-alt"> </i> 
            </a> 
        </td>
    </tr>
    
@endforeach

<div id="pagnav">
    {{$turns->links()}}
</div>