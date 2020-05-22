    
<style>
    .main-container{
        position: relative;
        display: flex;
        align-items: initial;
        justify-content: center;
        width: initial;
        width: 70%;
    }


    .turn-container{
        position: absolute;
        top: 0px;
        width: 70%;
        display: flex;
        align-self: center;
        flex-direction: column; 
    }

    .element{
        display: flex;
        flex-direction: column;
        align-items: left;
        margin: 10px 0px;
        padding: 20px;
        width: 100%;
        background-color: rgba(255,255,255,0.9);
        border-radius: 4px;
        box-shadow: 2px 2px 30px -15px rgba(0,0,0,0.2);

        font-family: 'Rubik', sans-serif;
        color: var(--main-gris-oscuro);
        font-size: 22px;

        position: relative;
    }

    .element:hover{
        background-color: rgba(255,255,255,0.7);
        cursor: pointer;
    }

    .classroom{
        font-weight: bold;
        margin: 5px 0px;
    }

    .deleteButton, .editButton{
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 28px;
        border-radius: 2px;
    }

    .editButton{
        top: 11px;
        right: 50px;
        font-size: 24px;
        padding: 1px 0px;
    }

    .editButton a, .deleteButton a{
        display: flex;
        padding: 3px 5px;
    }

    .editButton a{
        color: var(--main-azul-claro);
    }

    .deleteButton a{
        color: #c00;
    }

    .deleteButton:hover{
        background-color: #c00;
    }

    .editButton:hover{
        background-color: var(--main-azul-claro);
    }

    .deleteButton:hover a, .editButton:hover a{
        color: #fff;
    }

</style>

    <div class="turn-container">
    @foreach($turns as $turn)
        <div class="element" id="{{$turn->id}}">
            <div class="classroom">{{$turn->classroomName}}</div>
            
            {{$turn->day}}
            {{DATE_FORMAT(date_create_from_format('H:i:s', $turn->beginHour), 'H:i')}} - 
            {{DATE_FORMAT(date_create_from_format('H:i:s', $turn->endHour), 'H:i')}}

            @can('manage-turns')
            <div class="editButton">
                <a href="{{route('turnEdit', $turn->id)}}"><i class="fas fa-edit"></i></a>
            </div>
            @endcan

            @can('manage-turns')
            <div class="deleteButton">
                <a href="{{route('turnDelete', $turn->id)}}"><i class="far fa-minus-square"></i></a>
            </div>
            @endcan

        </div>
    @endforeach
    </div>