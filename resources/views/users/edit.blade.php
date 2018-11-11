@extends('layout')

@section('title', 'Edit user')

@section('content')
    <h3>Edit user</h3>

    <p>Editing the user with id {{ $user->id }}</p>

    @if($errors->any())
        <div class="alert alert-danger">
            <p>Please fix the following errors:</p>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('users.update', $user->id) }}">
        {{ method_field('PUT') }}
        {{ csrf_field() }}

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}">
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}">
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <br>
        <button type="submit">Update user</button>
    </form>

    <br>
    <p>
        <a href="{{ route('users.index') }}">Go back</a>
    </p>
@endsection
