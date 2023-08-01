<div class="row">
    <div class="d-inline">
        <a class="button-edit" href="{{ route('admin.banners.edit', $id) }}"><i class="fas fa-edit ml-2"></i></a>
{{--        <a class="button-show" href="{{ route('admin.users.show', $id) }}"><i class="fas fa-eye ml-2"></i></a>--}}
        <a class="button-destroy text-danger" href="{{ route('admin.banners.destroy', $id) }}"><i class="fas fa-trash ml-2"></i></a>
    </div>
</div>
