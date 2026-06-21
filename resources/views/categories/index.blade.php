<h1>Categories</h1>

<form method="POST" action="{{ route('categories.store') }}">
    @csrf
    <input type="text" name="name" placeholder="Category name">
    <button type="submit">Add</button>
</form>

<hr>

@foreach($categories as $category)
    <div>
        <strong>{{ $category->name }}</strong>

        <form method="POST" action="{{ route('categories.destroy', $category) }}">
            @csrf
            @method('DELETE')
            <button>Delete</button>
        </form>
    </div>
@endforeach