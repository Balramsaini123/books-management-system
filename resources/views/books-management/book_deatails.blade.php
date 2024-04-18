@extends('books-management.layout')
@section('content')

<div>
            <Navbar /><br /><br /><br /><br />
            <div class="emp-profile py-4">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card shadow-sm">
                                <div class="card-header bg-transparent text-center">
                                <img src="{{ asset('uploads/' . $data->cover_image_path) }}" class="img-thumbnail" width="75%" />
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card shadow-sm">
                                <div class="card-header bg-transparent border-0">
                                    <h3 class="mb-0"><i class="fa fa-clone pr-1"></i> Book Deatails</h3>
                                </div>
                                <div class="card-body pt-0"> 
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="30%">Book Title</th>
                                            <td width="2%">:</td>
                                            <td>{{ $data->book_title }}</td>
                                        </tr>
                                        <tr>
                                            <th width="30%">Author Name</th>
                                            <td width="2%">:</td>
                                            <td>{{ $data->author_name }}</td>
                                        </tr>
                                        <tr>
                                            <th width="30%">Book Description</th>
                                            <td width="2%">:</td>
                                            <td>{{ $data->book_description}}</td>
                                        </tr>
                                        <tr>
                                            <th width="30%">Book Price</th>
                                            <td width="2%">:</td>
                                            <td>{{ $data->price}}</td>
                                        </tr>
                                        <tr>
                                            <th width="30%">Book Rating</th>
                                            <td width="2%">:</td>
                                            <td>4.2/5</td>
                                        </tr>
                                        <tr>
                                            <th width="30%">In Stock</th>
                                            <td width="2%">:</td>
                                            <td>56</td>
                                        </tr>
                                        <tr>
                                            <th width="30%">Download Pdf</th>
                                            <td width="2%">:</td>
                                            <td><a href="{{ url('/download-book-pdf/'.$data->id)}}">{{ $data->file_path }}</a></td>
                                        </tr>
                                    </table>

                                    <button type="button" class="btn btn-primary" >Order Now</button>&nbsp;&nbsp;&nbsp;
                                </div>
                            </div>

                            <div></div>
                            <div class="card shadow-sm">
                               
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
@endsection