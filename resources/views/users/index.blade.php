@extends('layout')

@section('title', $title)

@section('content')

    <div class="d-flex justify-content-between align-items-end mb-2">
        <h1 class="pb-1">Users list</h1>

        <p><a href="{{ route('users.create') }}" class="btn btn-primary">New user</a>
        </p>
    </div>

    @if(count($users) == 0)
        No users found.
    @else
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Options</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form action="{{ route('users.destroy', $user) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <a href="{{ route('users.show', [$user->id]) }}" class="btn btn-link"><span
                                        class="oi oi-eye"></span></a>
                            <a href="{{ route('users.edit', [$user->id]) }}" class="btn btn-link"><span
                                        class="oi oi-pencil"></span></a>
                            <button type="submit" class="btn btn-link"><span class="oi oi-trash"></span></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
