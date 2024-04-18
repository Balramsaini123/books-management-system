<?php

namespace App\Http\Controllers;

use App\Models\Downloaded_book;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Session;
use Hash;

/**
 * Class AuthorController
 * @package App\Http\Controllers
 */
class AuthorController extends Controller
{
    /**
     * Display the registration form for new authors.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function registeration()
    {
        return view('books-management.register_newauthor');
    }

    /**
     * Process the creation of a new author.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create_author(Request $request)
    {
        // Implementation goes here
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);
        $new_user = new User();
        $new_user->name = $request->name;
        $new_user->email = $request->email;
        $new_user->password = Hash::make($request->password);
        // dd($new_user);
        $new_user->save();
     
        // Additional logic or redirection after successful data storage

        return redirect('login')->with('success', 'user stored successfully!');
    }

    /**
     * Display the login form for authors.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function login()
    {
        return view('books-management.login_author');
    }

    /**
     * Process the login request for authors.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login_author(Request $request)
    {
        // Implementation goes here

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Attempt to authenticate user
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }
        return redirect("login")->with('success','your log in credentials are not match');
    }

    /**
     * Display the dashboard for authors.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function dashboard()
    {
        return view('books-management.author_dashboard');
    }

    /**
     * Log out the currently logged-in author.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logOut()
    {
        // Implementation goes here
        Session::flush();
        Auth::logout();
        return redirect('login');
    }

    /**
     * Display a list of downloaded books for the logged-in user.
     *
     * @return \Illuminate\View\View
     */
    public function download_list(){
        $user = Auth::user();
        $downloads = $user->downloads;

    return view('books-management.list_of_downloadedbooks', ['downloads' => $downloads]);
    }
 
     /**
     * Display a list of all users' download history.
     *
     * @return \Illuminate\View\View
     */
    public function users_history(){
        $user_data = Downloaded_book::all();
        return view('/books-management.users_history',compact('user_data'));
    }
}
