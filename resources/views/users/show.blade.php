@extends('layout')

@section('title', "User details")

@section('content')
    <div class="card">
        <h4 class="card-header">
            <div class="d-flex justify-content-between align-items-end">
                User details
                <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">Edit user</a>
            </div>
        </h4>
        <div class="card-body">
            <table class="table table-user-information">
                <tbody>
                <tr>
                    <td>Name:</td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <td>Website:</td>
                    <td>{{ $user->website }}</td>
                </tr>
                </tbody>
            </table>

            <a href="{{ route('users.index') }}" class="btn btn-link">Go back</a>
        </div>
    </div>

@endsection
