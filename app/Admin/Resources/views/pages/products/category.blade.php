<ul class="list-group">
    @foreach($categories as $category)
        <li class="list-group-item d-flex" data-value="{{ $category->id }}" data-name="{{$category->name}}">
            <div class="horizontal-line"></div>
            <span class="category-name" style="cursor: pointer;">{{ $category->name }}</span>
            @if(count($category->sub_categories) > 0)
                <i class="fa fa-plus add-button mt-1 ml-2"></i>
                <i class="fa fa-minus d-none mt-1 ml-2"></i>
                <div class="vertical-line d-none"></div>
            @endif
        </li>
        @if(count($category->sub_categories) > 0)
            <ul class="list-group d-none" style="margin-left: 25px;">
                @include('admin::pages.products.category', ['categories' => $category->sub_categories])
            </ul>
            <div class="vertical-line"></div>
        @endif
    @endforeach
</ul>
