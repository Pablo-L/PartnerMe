@foreach($students as $student)
    <tr id="{{$student->id}}">
        <td>
            <a class="alias-links" href=" {{ action('StudentController@detail', ['alias' => $student->alias]) }} ">
                {{ @$student->alias }}
            </a>
        </td>
        <td>{{ $student->name }}</td>
        <td>{{ $student->description }}</td>
        <td>
            <a href=" {{ action('StudentController@edit', ['alias' => $student->alias]) }} "> 
                <i class="fas fa-edit"></i> 
            </a> 
        </td>
        <td> 
            <a class="delete-link" alias="{{$student->alias}}" id="{{$student->id}}"> 
                <i class="fas fa-trash-alt"> </i> 
            </a> 
        </td>
    </tr>
    
@endforeach

<div id="pagnav">
    {{$students->links()}}
</div>