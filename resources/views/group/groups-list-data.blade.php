@foreach($groups as $group)
    <tr>
        <td>
            {{ @$group->image }}
        </td>
        <td>
            {{ @$group->id }}
        </td>
        <td>
            <a class="item-links" href=" {{ action('GroupController@detail', ['id' => $group->id]) }} ">
                {{ @$group->groupName }}
            </a>
        </td>
        <td>
            {{ @$group->description }}
        </td>
        <td>
            <a href=" {{ action('GroupController@edit', ['id' => $group->id]) }} "> 
                <i class="fas fa-edit"></i> 
            </a> 
        </td>
        <td>
            <a href=" {{ action('GroupController@delete', ['id' => $group->id]) }} "> 
                <i class="fas fa-trash-alt"> </i> 
            </a> 
        </td>
    </tr>
@endforeach

<div id="pagnav">
    {{$groups->links()}}
</div>