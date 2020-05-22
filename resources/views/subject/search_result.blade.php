    
<style>
    .main-container{
        position: relative;
        display: flex;
        align-items: initial;
        justify-content: center;
        width: initial;
        width: 70%;
    }


    .subject-container{
        position: absolute;
        top: 0px;
        width: 70%;
        display: flex;
        align-self: center;
        flex-direction: column; 
    }

    .element{
        display: flex;
        /*align-items: center;*/
        margin: 10px 0px;
        padding: 20px;
        width: 100%;
        background-color: rgba(255,255,255,0.9);
        border-radius: 4px;
        box-shadow: 2px 2px 30px -15px rgba(0,0,0,0.2);

        font-family: 'Rubik', sans-serif;
        color: var(--main-gris-oscuro);
        font-weight: bold;
        font-size: 20px;

        position: relative;
    }

    .element:hover{
        background-color: rgba(255,255,255,0.7);
        cursor: pointer;
    }

    .deleteButton, .editButton{
        position: absolute;
        top: 14px;
        right: 15px;
        font-size: 28px;
        border-radius: 2px;
    }

    .editButton{
        top: 14px;
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

    <div class="subject-container">
    @foreach($subjects as $subject)
        <div class="element" id="{{$subject->subjectName}}">
            {{$subject->subjectName}}
        
            @can('manage-subjects')
            <div class="editButton">
                <a href="{{route('subjectEdit', $subject->subjectName )}}"><i class="fas fa-edit"></i></a>
            </div>
            @endcan

            @can('manage-subjects')
            <div class="deleteButton">
                <a href="{{route('subjectDelete',  $subject->subjectName)}}"><i class="far fa-minus-square"></i></a>
            </div>
            @endcan
        </div>
    @endforeach
    </div>