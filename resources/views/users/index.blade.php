@extends('layouts.main')

@section('content')

    <h1>User list</h1>
    <div class="float-right mb-2">
        <a href="{{ route('users.create') }}" class="btn btn-success">New User</a>
    </div>
    <table class="table table-striped table-bordered mt-2">
        <thead>
            <th>id</th>
            <th>name</th>
            <th>email</th>
            <th>role</th>
            <th>actions</th>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name }}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">edit</a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST">
                            @method('delete')
                            @csrf
                            <button class="btn btn-danger">delete</button>
                        </form>

                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection