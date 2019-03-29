<form action="{{ route('posts.index') }}" class="form form-inline" method="GET">
    <div class="form-group">
        <label for="query">Search: </label>
        <input type="text" class="form-control" name="query">
    </div>

    <div class="form-group">
        <button class="btn btn-success">Cerca</button>
    </div>

</form>