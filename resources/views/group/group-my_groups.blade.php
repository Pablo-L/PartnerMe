@extends('layouts.master-navbar')

@section('title', 'Tus grupos')

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../../css/group/group-my_groups.css') }}">
@endsection

@section('content')

    <div id="groupContainer">
        <div id="groupTitle">Tus grupos</div>
        <a id="groupCreateBtn" href="{{ URL::route('groupCreate') }}">Crear un grupo</a>
        <div id="form">
        <form action="{{action('GroupController@filteredList')}}" method="POST">
            @csrf
            <label for="subject">Asignatura:</label>
            <select id="selectSubject" name="subject">
            <option 
                @if($selected=="nulo")
                selected 
                @endif
                value="nulo">Seleccion una asignatura</option>
                @foreach($subjects as $subject)
                <option 
                @if($subject->id==$selected)
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
            <div class="element" id="{{$group->group_id}}">
                <div class="groupImage">
                    <img src="/storage/group_img/{{ $group->image }}">
                </div>
                <div class="groupContent">
                    <div class="groupContent-name">{{$group->groupName}}</div>
                    <div class="groupContent-desc">{{$group->description}}</div>
                </div> 

                @can('edit-groups', $group->group_id)
                <div class="editButton">
                    <a href="{{route('groupEdit', $group->group_id)}}"><i class="fas fa-edit"></i></a>
                </div>
                @endcan

                @can('delete-groups', $group->group_id)
                <div class="deleteButton">
                    <a href="{{route('groupDelete', $group->group_id)}}"><i class="far fa-minus-square"></i></a>
                </div>
                @endcan

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

        subjectSelect.addEventListener('change', () => {
            filterBtn.click()
        })

        let elementPath
        for(e of elements){
            e.addEventListener('click', event => {
                console.log('ha clickado!' + event.currentTarget.id)
                elementPath = window.location.origin + '/group/detail/' + event.currentTarget.id + '?option=' + searchField.value
                window.location.href = elementPath
            })
        }


    </script>
    

@endsection