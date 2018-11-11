@extends('layout')

@section('title', 'Edit user')

@section('content')
    <div class="card">
        <h4 class="card-header">Edit user</h4>
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

                <form method="post" action="{{ route('users.update', $user->id) }}">
                {{ method_field('PUT') }}
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $user->name) }}">
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $user->email) }}">
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <button type="submit" class="btn btn-primary">Update user</button>
                <a href="{{ route('users.index') }}" class="btn btn-link">Go back</a>
            </form>
        </div>
    </div>
@endsection
