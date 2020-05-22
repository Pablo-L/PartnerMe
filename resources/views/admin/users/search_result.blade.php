    
<style>
    .main-container{
        position: relative;
        display: flex;
        align-items: initial;
        justify-content: center;
        width: initial;
        width: 70%;
    }


    .user-container{
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

        position: relative;
    }

    .element:hover{
        background-color: rgba(255,255,255,0.7);
        cursor: pointer;
    }

    .user-image{
        width: 100px;
        height: 100px;
        border-radius: 50%;
        
        background-image: url(../../imgs/default-user-image.png);
        background-repeat: no-repeat;
        background-size: cover;
    }

    .user-content{
        font-family: 'Rubik', sans-serif;
        font-size: 24px;
        margin-left: 20px;
    }

    .user-content-alias, .user-content-name{
        padding: 2px 0px;
    }

    .user-content-alias{
        font-weight: bold;
        color: var(--main-morado-apagado);
    }

    .user-content-name{
        color: var(--main-gris-oscuro);
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
    
    <div class="user-container">
    @foreach($users as $user)
        <div class="element" id="{{$user->id}}">
            <div class="user-image" style="background-image:url('{{ $user->image }}')"></div>
            <div class="user-content">
                <div class="user-content-alias">{{ $user->alias }}</div>
                <div class="user-content-name">{{ $user->name }} {{ $user->lastName }}</div>
            </div>

            @can('edit-users', $user)
            <div class="editButton">
                <a href="{{route('admin.users.edit', $user)}}"><i class="fas fa-edit"></i></a>
            </div>
            @endcan

            @can('delete-users')
            <div class="deleteButton">
                <a href="{{route('admin.deleteFromSearch', $user->id)}}"><i class="far fa-minus-square"></i></a>
            </div>
            @endcan
        </div>
    @endforeach

    </div>