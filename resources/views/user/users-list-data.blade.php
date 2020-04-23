@foreach($users as $user)
    <tr id="{{$user->id}}">
        <td>
            <a class="alias-links" href=" {{ action('UserController@detail', ['alias' => $user->alias]) }} ">
                {{ @$user->alias }}
            </a>
        </td>
        <td class="username_cells">{{ $user->name }}</td>
        <td class="description_cells">{{ $user->description }}</td>
        <!-- No incluir hasta arreglar paginación con AJAX
            <td>{{$user->puntuation}}</td>
        -->
        
        <td>
            <a href=" {{ action('UserController@edit', ['alias' => $user->alias]) }} "> 
                <i class="fas fa-edit"></i> 
            </a> 
        </td>
        <td> 
            <a class="delete-link" alias="{{$user->alias}}" user_id="{{$user->id}}"> 
                <i class="fas fa-trash-alt"> </i> 
            </a> 
        </td>
    </tr>
    
@endforeach

<div id="pagnav">
    {{$users->links()}}
</div>