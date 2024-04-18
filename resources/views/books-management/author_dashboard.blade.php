@extends('books-management.layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><strong>Dashboard</strong></div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                
                </div>
                @else
                <div class="alert alert-success">
                <div class="d-block"> Hello! {{auth()->user()->name}} you loggedin successfully</div>
                </div>
                @endif
                @if(auth()->user()->is_admin)
                <a href="{{ route('add.book') }}" class="btn btn-success">Add Book</a><br><br>
                @endif
                <a href="{{ route('stored.books') }}" class="btn btn-success">Show All Books</a>
                <a href="{{ route('download.list') }}" class="btn btn-success">Your downloded books</a>
                @if(auth()->user()->is_admin)
                <a href="{{ route('users.history') }}" class="btn btn-success">All users history</a><br><br>
                @endif
                
            </div>
        </div>
    </div>
</div>
@endsection