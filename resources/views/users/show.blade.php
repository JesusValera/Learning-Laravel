@extends('layout')

@section('content')
    <p>Username: {{ $user->name }}</p>

    <a href="{{ route('user_index') }}">Go back</a>
@endsection
