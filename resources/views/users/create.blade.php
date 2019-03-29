@extends('layouts.main')

@section('content')
    <h1>Create new user</h1>
    <form action="{{ route('users.store') }}" method="POST" class="form">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email">
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
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <button class="btn btn-success">Save</button>
        </div>
    </form>
@endsection