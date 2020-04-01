<form action="{{action('SubjectController@update')}}"method='POST'>
    @csrf
    {{method_field('POST')}}

    @if(isset ($subject) && is_object($subject))
        <input type="hidden" name="id" value="{{$subject->id}}"/>
    @endif

    <div id="name" class="left">
        <label>Nombre de la asignatura:</label>
        <input type="text" name="subjectName" id="subjectName">
    </div>

    <div id="department" class="right">
        <label>Departamento:</label>
        <input type="text" name="department"  id="department">
    </div>
    
    <button type="submit">Enviar</button>

</form>