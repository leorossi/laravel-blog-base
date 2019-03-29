<form action="{{ route('posts.store') }}" method="POST" class="form">
    @csrf
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" name="title" class="form-control"/>
    </div>

    <div class="form-group">
        <label for="body">Body:</label>
        <textarea type="text" name="body" class="form-control"></textarea>

    </div>

    <button class="btn btn-success">Save</button>
</form>