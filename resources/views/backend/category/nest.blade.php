<option value="{{ $category->id }}"
    {{ (isset($selectedCategoryId) && $selectedCategoryId == $category->id) ? 'selected' : '' }}>
    {{ $each }}{{ $category->name }}
</option>

@if ($category->children->count())
    @php($each .= '-')
    @foreach ($category->children as $child)
        @if(isset($selectedCategoryId) && $selectedCategoryId == $child->id)
            @include('backend.category.nest', [
          'category' => $child,
          'each' => $each,
          'selectedCategoryId' => $selectedCategoryId
        ])
        @else
            @include('backend.category.nest', [
          'category' => $child,
          'each' => $each,
        ])
        @endif

    @endforeach
@endif
