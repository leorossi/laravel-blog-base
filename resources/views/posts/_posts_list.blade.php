@if(app('request')->input('query'))
    <em>Search results for "{{ app('request')->input('query') }}"</em>
@endif
<h5>There are {{ count($posts) }} posts</h5>

<ul class="list-group">
    @foreach($posts as $post)
        <li class="list-group-item">
            <a href="{{ route('posts.show', [ 'post' => $post->id ]) }}">{{ $post->title }} (id: #{{ $post->id }})</a>
        </li>
    @endforeach
</ul>