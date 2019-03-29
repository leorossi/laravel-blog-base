@extends('layouts.main')

@section('content')
    <h1>Edit user #{{ $user->id }}</h1>
    <form action="{{ route('users.update', $user) }}" method="POST" class="form">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" value="{{ $user->name }}">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" value="{{ $user->email }}">
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control">

        </div>

        <div class="form-group">
            <label for="role">Role:</label>
            <select name="role_id" class="form-control">
                <option value="-1">Select role...</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}"
                    @if ($user->role->id == $role->id)
                        selected="selected"
                    @endif
                    >{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <button class="btn btn-success">Save</button>
        </div>
    </form>
@endsection