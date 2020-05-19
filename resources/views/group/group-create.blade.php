@extends('layouts.master-navbar')

@php
    $groupExists = isset($group) && is_object($group) ? true : false;
    $usersExists = isset($users) && is_object($users) ? true : false;
@endphp

@if($groupExists)
    @section('title', 'Modificar grupo')
@else
    @section('title', 'Crear grupo')
@endif

@section('head')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('../../css/group/group-form.css') }}">
@endsection

@section('content')

    <div class="group-form-container">
        
        <form id="group-form" class="group-form-container"  
            @if($groupExists)
                action="{{ route('groupUpdate', $group) }}"  
            @else
                action="{{action('GroupController@save')}}"
            @endif
        method="POST" enctype="multipart/form-data">

               
        @csrf
            
            <div class="group-form-title">
                @if($groupExists)
                    Modificar grupo '{{$group->groupName}}'
                @else
                    Creación de un grupo
                @endif
            </div>
        
            <div class="group-form-upload">
                @if($groupExists)
                    <img id="output" src="/storage/group_img/{{ $group->image }}" width="100" height="100">
                @else
                    <img id="output" src="" width="100" height="100">
                @endif
                <div class="group-form-upload-select">
                    <button class="btnUpload">Seleccionar fichero</button>
                    <input id="imageUpload" type="file" name="image" accept="image/*"  
                    onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                </div>
            </div>

            <div class="group-form-name">
                <label>Nombre del grupo:</label>
                <input type="text" name="groupName" value="{{ $group->groupName ?? old('groupName') }}">
                @error('groupName')
                    <div class="error_message" style="width: 81%;">
                        <span>
                            {{$message}}
                        </span>
                    </div>
                @enderror
            </div>

            <div class="group-form-desc">
                <label>Descripción del grupo:</label>
                <textarea name="description" value="{{ $group->description ?? old('description') }}">{{$group->description ?? old('description') }}</textarea>
                @error('description')
                    <div class="error_message" style="width: 81%;">
                        <span>
                            {{$message}}
                        </span>
                    </div>
                @enderror
            </div>

            <div class="group-form-subject">
                <label>Asignatura</label>
                <select name="subject" id="subjectSelect">
                    @if($groupExists)
                        {{  $subject = App\Http\Controllers\GroupController::getSubject($group->turn_id) }}
                        <option value="{{ $subject->id }}">{{$subject->subjectName}}</option>
                    @else
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">{{$subject->subjectName}}</option>
                        @endforeach
                    @endif
                </select>            
            </div>

            <div class="group-form-turn">
                <label>Turno</label>
                <select name="turn" id="turnSelect" value="{{ $group->turn_id ?? '' }}">
                </select>
            </div>

            @if(! $groupExists)
                <input name="groupCreator" type="hidden" value="{{ Auth::user()->id }}">
            @endif

            <div class="group-form-usersList">
                <div class="group-form-usersList-title">
                    <label>Lista de integrantes</label>
                    <i id="btnAddUser" class="fas fa-plus-circle"></i>
                </div>

                <div class="usersListContainer"></div>

                <div class="group-form-usersList-result">
                    @if($usersExists)
                        @foreach($users as $user)
                            <div class="usersListItemResult">
                                <div class="usersListItem-content">
                                    <div class="usersListItem-image"></div>
                                    <div class="usersListItem-text" id="{{$user->id}}">{{$user->name}}</div>
                                </div>
                                <div><i class="far fa-minus-square"></i></div>
                                <input type="hidden" name="users[]" value="{{$user->id}}">
                            </div>
                        @endforeach
                    @endif
                </div>

            </div>
            
            <button class="group-form-btn" type="submit">
                @if($groupExists)
                    Modificar grupo
                @else
                    Crear grupo
                @endif
            </button>
            
        </form>
    
    </div>

    <script>

        const subject = document.getElementById('subjectSelect')
        const turnSelect = document.getElementById('turnSelect')
        const btnAddUser = document.getElementById('btnAddUser')
        const usersList = document.getElementsByClassName('usersListContainer')[0]
        const usersListItems = document.getElementsByClassName('usersListItem')
        const usersItems = document.getElementsByClassName('usersListItem-text')
        const usersResult = document.getElementsByClassName('group-form-usersList-result')[0]
        const deleteIcons = document.getElementsByClassName('fa-minus-square')

        updateDeletions()
        let fetched = false;
        let fetchText;

        function fillUsersList(text){

            let addedUsers = []
            for(it of usersResult.children){
                addedUsers.push(it.children[0].children[1].id)
            }


            users = JSON.parse(text)
            users.forEach(user => { 
                //solo muestro aquellos que no tengo añadidos
                if(! addedUsers.includes(user.id.toString())){ 
                    mainDiv = document.createElement('div')
                    contentDiv = document.createElement('div')
                    imageDiv = document.createElement('div')
                    textDiv = document.createElement('div')
                    
                    contentDiv.classList.add('usersListItem-content')
                    imageDiv.classList.add('usersListItem-image')
                    textDiv.classList.add('usersListItem-text')
                    textDiv.setAttribute("id", user.id); 
                    textDiv.appendChild(document.createTextNode(user.name))
                    
                    contentDiv.appendChild(imageDiv) 
                    contentDiv.appendChild(textDiv)
                    mainDiv.classList.add('usersListItem')
                    mainDiv.appendChild(contentDiv)
                    usersList.appendChild(mainDiv)
                }
            })
        }

        function addUserResult(){
            for(let item of usersListItems){
                item.addEventListener('click', () => {
                    copy = item.cloneNode(true);

                    iconDiv = document.createElement('div')
                    iconElem = document.createElement('i')
                    iconElem.classList.add('far')
                    iconElem.classList.add('fa-minus-square')
                    iconDiv.appendChild(iconElem)
                    copy.appendChild(iconDiv)

                    inputHidden = document.createElement('input')
                    inputHidden.setAttribute("type", "hidden")
                    inputHidden.setAttribute("name", "users[]")
                    inputHidden.setAttribute("value", item.children[0].children[1].id)
                    copy.appendChild(inputHidden)

                    copy.classList.remove('usersListItem')
                    copy.classList.add('usersListItemResult')
                    usersResult.appendChild(copy)


                    usersList.removeChild(item)

                })
            }
        }

        function updateDeletions(){
            for(delIcon of deleteIcons){
                delIcon.addEventListener('click', item => {
                    usersResult.removeChild(item.target.parentElement.parentElement)
                    //usersInput.removeChild(item.target.parentElement.parentElement)
                })
            }
        }

        usersResult.addEventListener('DOMNodeInserted', event => {
            updateDeletions()
        })


        btnAddUser.addEventListener('click', () => {
            usersList.classList.toggle("active");
            if(usersList.classList.contains("active")){
                if(! fetched){
                    path = window.location.origin + "/getUsers" 
                    fetch(path, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                    },
                    method: "get",
                    }).then(response => {
                        return response.text();
                    }).then(text => {
                        fetchText = text
                        fillUsersList(text)} 
                    ).then(() => addUserResult()
                    ).then(() => fetched = true)
                }else{
                    fillUsersList(fetchText)
                    addUserResult()
                }

            }else{
                usersList.innerHTML = ""
            }
        })

        //Lo llamo al inicio para rellenar los turnos
        fillTurns()

        subject.addEventListener('change', () => {
            turnSelect.querySelectorAll('*').forEach(n => n.remove());
            fillTurns()
        })    

        function fillTurns(){
            //fetch mejor que estar mandando peticiones con jQuery
            path = window.location.origin + "/turn/getTurns/" + subject.value

            fetch(path, {
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
            },
            method: "get",
            }).then(response => {
                return response.text();
            }).then(turnsStr => {
                //return console.log(turns);
                turns = JSON.parse(turnsStr).turns
                turns.forEach(turn => {
                    turnText = turn.classroomName + " - " + turn.day + " " + turn.beginHour.toString().substr(0,5) + " - " + turn.endHour.toString().substr(0,5)
                    opt = document.createElement('option')
                    opt.value = turn.id

                    targetValue = turnSelect.attributes.value.value //no se porque turnSelect.value devuelve vacio (?)
                    if(opt.value === targetValue){
                        opt.selected = 'selected'
                    }
                    opt.appendChild(document.createTextNode(turnText))
                    turnSelect.appendChild(opt)
                })
            })
        }

    </script>

@endsection