<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Response;
use Auth;
use App\Models\Downloaded_book;

class BookController extends Controller
{
   /**
     * Display the form for adding a new book.
     *
     * @return \Illuminate\View\View
     */
     public function add_new_book(){
        return view('books-management.add_book');
     }

     /**
     * Store a newly created book in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
     public function submit_book(Request $request){

            $request->validate([
               'title' => 'required|max:70',
               'author' => 'required|max:50',
               'description' => 'required',
               'price' => 'required|numeric|min:0',
               'coverpage' => 'required|image|mimes:jpeg,png,jpg,gif',
               'pdf' => 'required|mimes:pdf,doc,docx'
            ]);
            // log::info('2');
            $filename = rand().'bookcover.'.$request->file('coverpage')->getClientOriginalName();
            $request->file('coverpage')->move('uploads',$filename);
           
            $pdffile = rand().'bookpdf.'.$request->file('pdf')->getClientOriginalName();
            $request->file('pdf')->move('files',$pdffile);

            $new_book = new Book();
            $new_book->book_title = $request->title;
            $new_book->author_name = $request->author;
            $new_book->book_description = $request->description;
            $new_book->price = $request->price;
            $new_book->cover_image_path = $filename;
            $new_book->file_path = $pdffile;
            //  dd($new_book);
            $new_book->save();
     
            // Additional logic or redirection after successful data storage
    
            return redirect('dashboard')->with('success', 'Book Added Successfully');

     }

     /**
     * Display a listing of stored books.
     *
     * @return \Illuminate\View\View
     */

     public function stored_books(){
      $data = Book::all();
    return view('books-management.stored_books', compact('data'));
     }

      /**
     * Download a book and store download information in the database.
     *
     * @param  int  $id  The ID of the book to download
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
     public function download($id){
      $data = Book::find($id);
      $filepath = public_path("files/{$data->file_path}");
      // dd($filepath);
      // return \Response::download($filepath);

      $userEmail = Auth::user()->email;

      // Get the book title based on $bookId
      $bookTitle = Book::findOrFail($id)->book_title;
   //   dd($userEmail,$bookTitle);
      // Store the download information in the database
      Downloaded_book::create([
          'book_title' => $bookTitle,
          'user_email' => $userEmail,
      ]);
      
      return \Response::download($filepath);
     }

     /**
     * Display book detail.
     *
     * @return \Illuminate\View\View
     */
     public function book_details($id){
       $data = Book::find($id);
       return view('books-management.book_deatails', compact('data'));
     }

      /**
     * delete specific book.
     *
     *@return \Illuminate\Http\RedirectResponse
     */
     public function book_delete($id){
      $data = Book::find($id);
      $data->delete();
      return redirect()->route('stored.books')->with('success','book deleted successfully');
     }
}
