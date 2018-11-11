@extends('layout')

@section('title', $title)

@section('content')
    <h1>Users list</h1>

    <p>
        <a href="{{ route('users.create') }}" class="btn btn-primary">New user</a>
    </p>

    @if(count($users) == 0)
        No users found.
    @else
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('users.show', [$user->id]) }}">Details</a>
                        <a href="{{ route('users.edit', [$user->id]) }}">Edit</a>
                        <form action="{{ route('users.destroy', $user) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection

@section('sidebar')
    <h3>@parent Subheader</h3>
@endsection
