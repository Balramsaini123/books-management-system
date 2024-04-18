@extends('books-management.layout')
@section('content')
<h2>Users history list</h2>
@if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                
                </div>
                @endif
<table>
    <thead>
        <tr>
            <th style="border: 1px solid #dddddd; padding: 8px; background-color: #f2f2f2;">ID</th>
            <th style="border: 1px solid #dddddd; padding: 8px; background-color: #f2f2f2;">Book title</th>
            <th style="border: 1px solid #dddddd; padding: 8px; background-color: #f2f2f2;">User email</th>
            <!-- Add more table headers as needed -->
        </tr>
    </thead>
    <tbody>
        @foreach ($user_data as $item)
            <tr>
                <td style="border: 1px solid #dddddd; padding: 8px;">{{ $item->id }}</td>
                <td style="border: 1px solid #dddddd; padding: 8px;">{{ $item->book_title }}</td>
                <td style="border: 1px solid #dddddd; padding: 8px;">{{ $item->user_email }}</td>
                <!-- Add more table cells for additional data fields -->
            </tr>
        @endforeach
    </tbody>
</table>
@endsection