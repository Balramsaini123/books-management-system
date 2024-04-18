@extends('books-management.layout')
@section('content')
    <h1>Downloads History</h1>

    <ul>
        @foreach ($downloads as $download)
            <li>{{ $download->book_title }}</li>
        @endforeach
    </ul>
@endsection