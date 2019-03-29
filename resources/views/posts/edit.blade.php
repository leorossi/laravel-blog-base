<form action="{{ route('posts.update', ['post' => $post->id ]) }}" method="POST">
    @method('delete')
    @csrf
    <label for="title">Titolo:</label>
    <input type="text" name="title" value="{{ $post->title }}"/>

    <label for="body">Testo:</label>
    <textarea type="text" name="body">{{ $post->body }}</textarea>

    <button>Invia</button>
</form>