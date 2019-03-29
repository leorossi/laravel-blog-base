<h1>Hello World</h1>
@if(isset($nomi))
    <ul>
        @foreach($nomi as $name)
            <li>{{ $name }}</li>
        @endforeach

    </ul>
@endif