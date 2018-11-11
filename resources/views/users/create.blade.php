@extends('layout')

@section('title', 'Create a new user')

@section('content')

    <div class="card">
        <h4 class="card-header">Create new user</h4>
        <div class="card-body">
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

            <form method="post" action="{{ route('users.store') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <button type="submit" class="btn btn-primary">Create user</button>
                <a href="{{ route('users.index') }}" class="btn btn-link">Go back</a>
            </form>
        </div>
    </div>

@endsection
