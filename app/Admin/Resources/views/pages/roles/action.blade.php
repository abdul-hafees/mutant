@can('update', $role)
    <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-icon btn-pure btn-default ladda-button btn-edit" data-toggle="tooltip" data-original-title="Edit" data-plugin="ladda" data-style="zoom-in">
        <span class="ladda-label"><i class="icon wb-edit" aria-hidden="true"></i></span>
    </a>
@endcan

@can('delete', $role)
    <a href="{{ route('admin.roles.destroy', $role->id) }}" class="btn btn-sm btn-icon btn-pure btn-default ladda-button btn-delete" data-toggle="tooltip" data-original-title="Edit" data-plugin="ladda" data-style="zoom-in">
        <span class="ladda-label"><i class="fa fa-trash text-danger" aria-hidden="true"></i></span>
    </a>
@endcan
