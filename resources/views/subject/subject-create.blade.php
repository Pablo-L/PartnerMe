<form action="{{action('SubjectController@postForm')}}"method='POST'>
    @csrf
    {{method_field('POST')}}

    <input type="text" name="subjectName" id="subjectName">
    <input type="text" name="department"  id="department">
    <button type="submit">Enviar</button>

</form>