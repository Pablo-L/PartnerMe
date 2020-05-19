@extends('layouts.master-navbar')

@section('title', 'Editar asignatura')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../../css/subject/subject-form.css') }}">
@endsection

@section('content')

<div class="subject-form-container">
        <div class="subject-form-title">Editar asignatura</div>
            <form id="subject-form" class="subject-form-container" action="{{action('SubjectController@update')}}"method='POST'>
                @csrf
                {{method_field('POST')}}

                @if(isset ($subject) && is_object($subject))
                    <input type="hidden" name="id" value="{{$subject->id}}"/>
                @endif

                <div id="name" class="subject-form-name">
                    <label>Nombre de la asignatura:</label>
                    <input type="text" name="subjectName" id="subjectName" value="{{$subject->subjectName ?? ''}}">
                    @error('subjectName')
                    <div class="error_message" style="width: 81%;">
                        <span>
                            {{$message}}
                        </span>
                    </div>
                    @enderror
                </div>

                <div id="department" class="subject-form-desc">
                    <label>Departamento:</label>
                    <input type="text" name="department"  id="department" value="{{$subject->department ?? ''}}">
                    @error('department')
                    <div class="error_message" style="width: 81%;">
                        <span>
                            {{$message}}
                        </span>
                    </div>
                    @enderror
                </div>
                
                <button type="submit" class="subject-form-btn">Enviar</button>

            </form>
        </div>
    </div>

@endsection