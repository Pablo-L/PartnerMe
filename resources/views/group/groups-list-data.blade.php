@foreach($groups as $group)
    <tr>
        <td>
            <img src="/storage/group_img/{{ @$group->image }}">
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

        @can('edit-groups', $group->id)
            <td>
                <a href=" {{ action('GroupController@edit', ['id' => $group->id]) }} "> 
                    <i class="fas fa-edit"></i> 
                </a> 
            </td>
        @else
            <td></td>
        @endcan


        @can('delete-groups', $group->id)
        <td>
            <a href=" {{ action('GroupController@delete', ['id' => $group->id]) }} "> 
                <i class="fas fa-trash-alt"> </i> 
            </a> 
        </td>
        @else
            <td></td>
        @endcan

    </tr>
@endforeach

<div id="pagnav">
    {{$groups->links()}}
</div>