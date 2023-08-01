<div class="row">
    <a class="button-edit" href="{{ route('admin.hubs.edit', $id) }}">
        <i class="fas fa-edit ml-3"></i>
    </a>
    <a class="button-destroy text-danger"
       href="{{ route('admin.hubs.destroy', $id) }}">
        <i class="fas fa-trash ml-3"></i>
    </a>
</div>
