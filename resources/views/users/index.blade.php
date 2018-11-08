@extends('layout')

@section('title', $title)

@section('content')
    <h1>Users list</h1>

    <ul>
        @forelse($users as $user)
            <li>{{ $user->name }}, ({{ $user->email }}) </li>
        @empty
            <li>No users found.</li>
        @endforelse
    </ul>
@endsection

@section('sidebar')
    <h3>@parent Subheader</h3>
@endsection
