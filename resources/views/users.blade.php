@extends('layouts.app')

@section('title', $title)

@section('content')
    <h1>Users</h1>

    <ul>
        @forelse($users as $user)
            <li>{{ $user }}</li>
        @empty
            <li>No users found.</li>
        @endforelse
    </ul>
@endsection
