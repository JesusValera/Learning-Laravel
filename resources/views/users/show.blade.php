@extends('layout')

@section('title', "User {$user->id}")

@section('content')
    <h1>User #{{ $user->id }}</h1>

    <p>
        <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">Edit user</a>
    </p>

    <p>Username: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>

    <a href="{{ route('users.index') }}">Go back</a>
@endsection
