@extends('layout')

@section('title', "User {$user->id}")

@section('content')
    <h1>User #{{ $user->id }}</h1>

    <p>
        <a href="{{ route('user.edit', $user) }}" class="btn btn-primary">Edit user</a>
    </p>

    <p>Username: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>

    <a href="{{ route('user.index') }}">Go back</a>
@endsection
