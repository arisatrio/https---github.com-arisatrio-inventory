@if ($deleted_at == null)
    <button class="btn btn-sm btn-outline-danger" onclick="destroy({{ $id }})">
        <i class="fa fa-trash"></i>
    </button>
    <button class="btn btn-sm btn-outline-info" title="Edit" onclick="edit({{ $id }})">
        <i class="fa fa-edit"></i>
    </button>
    
@else
    <button class="btn btn-sm btn-outline-warning" onclick="restore({{ $id }})">
        <i class="fa fa-recycle"></i>
    </button>
@endif