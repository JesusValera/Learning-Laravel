@extends('layout')

@section('title', 'Create a new user')

@section('content')
    <h3>Creating new user.</h3>

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

    <form method="post" action="{{ route('user_store') }}">
        {{ csrf_field() }}
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}">
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}">
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <br>
        <button type="submit">Create user</button>
    </form>

    <p>
        <a href="{{ route('user_index') }}">Go back</a>
    </p>
@endsection
