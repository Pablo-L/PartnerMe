    
<style>
    .main-container{
        position: relative;
        align-items: initial;
        justify-content: center;
        width: initial;
        width: 70%;
    }

    .groupContainer{
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
        font-size: 20px;
    }

    .element:hover{
        background-color: rgba(255,255,255,0.7);
        cursor: pointer;
    }

    .groupImage img{
        max-width: 100px;
        max-height: 100px;
        border-radius: 50%;
    }

    .groupContent{
        display: flex;
        flex-direction: column;
        margin-left: 20px;
    }

    .groupContent-name, .group-content-desc{
        padding: 2px 0px;
    }

    .groupContent-name{
        font-weight: bold;
    }

</style>

    <div class="groupContainer">
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