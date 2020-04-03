@foreach($subjects as $subject)
    <tr id = "{{ $subject->id}}">
        <td ><a href=" {{ action('SubjectController@detail', ['subjectName' => $subject->subjectName]) }} ">{{ @$subject->subjectName }}</a></td>
        <td >{{ @$subject->department }}</td>
        <td>
            <a href=" {{ action('SubjectController@edit', ['name' => $subject->subjectName]) }} "> 
                <i class="fas fa-edit"></i> 
            </a> 
        </td>
        <td> 
            <a href=" {{ action('SubjectController@delete', ['name' => $subject->subjectName]) }} "> 
                <i class="fas fa-trash-alt"> </i> 
            </a> 
        </td>
    </tr>
    
@endforeach

<div id="pagnav">
    {{$subjects->links()}}
</div>