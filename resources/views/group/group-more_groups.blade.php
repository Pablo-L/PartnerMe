@extends('layouts.master-navbar')

@section('title', 'Otros grupos')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../../css/group/group-more_groups.css') }}">
@endsection

@section('content')

    <div id="groupContainer">
        <div id="groupTitle">Otros grupos</div>
        <a id="groupCreateBtn" href="{{ URL::route('groupCreate') }}">Crear un grupo</a>
        <div id="form">
        <form action="{{action('GroupController@otherFilteredList')}}" method="POST">
            @csrf
            <label for="nameTb">Nombre:</label>
            <input type="text" name="nameTb" id="nameTb" value="{{$name}}"> <br>
            <label for="subject">Asignatura:</label>
            <select id="selectSubject" name="subject">
                <option 
                @if($selected=="nulo")
                selected 
                @endif
                value="nulo">Seleccione una asignatura</option>
                @foreach($subjects as $subject)
                <option 
                @if($subject->id == $selected)
                selected 
                @endif
                value="{{$subject->id}}">{{$subject->subjectName}}</option>
                @endforeach
            </select>
            <button id="filterBtn" type="submit">Filtrar</button>
        </form>
        </div>
    
        <div class="groupCardContainer">
        @foreach($groups as $group)
            <div class="element" id="{{$group->id}}">
                <div class="groupImage">
                    <img src="/storage/group_img/{{ $group->image }}">
                </div>
                <div class="groupContent">
                    <div class="groupContent-name">{{$group->groupName}}</div>
                    <div class="groupContent-desc">{{$group->description}}</div>
                </div> 

            </div>
        @endforeach
        </div>

        <div id="pagnav">
            {{$groups->links()}}
        </div>

    </div>

    <script>
        
        const subjectSelect = document.getElementById('selectSubject')
        const filterBtn = document.getElementById('filterBtn')
        const elements = document.getElementsByClassName('element')
        const searchField = document.getElementById('search-select')
//
        //subjectSelect.addEventListener('change', () => {
        //    filterBtn.click()
        //})

        let elementPath
        for(e of elements){
            e.addEventListener('click', event => {
                console.log('holi')
                console.log('ha clickado!' + event.currentTarget.id)
                elementPath = window.location.origin + '/group/detail/' + event.currentTarget.id + '?option=' + searchField.value
                window.location.href = elementPath
            })
        }


    </script>

@endsection