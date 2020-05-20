    
<style>
    .main-container{
        position: relative;
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
        align-items: center;
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
    }

    .element:hover{
        background-color: rgba(255,255,255,0.7);
        cursor: pointer;
    }

</style>

    <div class="subject-container">
    @foreach($subjects as $subject)
        <div class="element" id="{{$subject->subjectName}}">
            {{$subject->subjectName}}
        </div>
    @endforeach
    </div>