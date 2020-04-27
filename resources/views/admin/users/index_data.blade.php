@foreach($users as $user)
    <tr id="{{$user->id}}">
        <td>
            <a class="alias-links" href=" {{ route('admin.users.show', $user->id) }} ">
                {{ @$user->alias }}
            </a>
        </td>

        <td>{{ implode(', ' , $user->roles()->get()->pluck('rolName')->toArray()) }}</td>

        <td class="username_cells">{{ $user->name }}</td>
        <td class="description_cells">{{ $user->description }}</td>
        <!-- No incluir hasta arreglar paginación con AJAX
            <td>{{$user->puntuation}}</td>
        -->
        
        <!-- Solo verán el boton de editar aquellos que puedan editar -->
        @can('edit-users') 
        <td>
            <a href=" {{ route('admin.users.edit', $user->id) }} "> 
                <i class="fas fa-edit"></i> 
            </a> 
        </td>
        @endcan

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