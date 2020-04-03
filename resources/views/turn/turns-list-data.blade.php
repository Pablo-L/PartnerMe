@foreach($turns as $turn)
    <tr id = "{{ $turn->id}}">
        <td >{{ @$turn->classroomName}}</td>
<<<<<<< Updated upstream
        <td ><a href=" {{ action('TurnController@detail', ['id' => $turn->id]) }} ">{{ @$turn->day }}</a></td>
        <td >{{ @$turn->beginHour }}</td>
        <td >{{ @$turn->endHour }}</td>
=======
        <td >{{ @$turn->day }}</td>
        <td >{{ DATE_FORMAT(date_create_from_format('H:i:s', $turn->beginHour), 'H:i') }}</td> 
        <td >{{ DATE_FORMAT(date_create_from_format('H:i:s', $turn->endHour), 'H:i') }}</td> 
>>>>>>> Stashed changes
        <td >{{ @$turn->subjectName }}</td>
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