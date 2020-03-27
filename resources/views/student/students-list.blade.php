@extends('layouts.master-navbar')

@section('title', 'Lista de estudiantes')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="../../css/student/student-index.css">
@endsection

@section('content')
    <table id = "students-table">
        <tr>
            <th>Alias</th>
            <th>Nombre del alumno</th>
            <th>Descripción</th>
            <th>Modificar</th>
            <th>Eliminar</th>
        </tr>
        @foreach($students as $student)
            <tr>
                <td>
                    <a class="alias-links" href=" {{ action('StudentController@detail', ['alias' => $student->alias]) }} ">
                        {{ @$student->alias }}
                    </a>
                </td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->description }}</td>
                <td> <a href=""> <i class="fas fa-edit"></i> </a> </td>
                <td> <a href=""> <i class="fas fa-trash-alt"> </i> </a> </td>
            </tr>
        @endforeach

    </table>
@endsection
