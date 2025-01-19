<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|max:50',
            'password' => 'required|string|max:50'
        ]);
        User::create([
            'email' => $request->email ,
            'password' => $request->password
            ]
        );
        return redirect()->route('login')->with('success', 'User Registered! Please login.');
    }
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function authenticate(Request $request){
        
        // Validate the request data
    $validatedData = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Attempt authentication with validated data
    if (Auth::attempt($validatedData)) {

        Session::put('user_email', Auth::user()->email);
        Session::put('user_id', Auth::id());
        Session::put('user_status', Auth::user()->role);

        return redirect()->route('home')->with('success', 'Logged in successfully!');
    } else {
        return redirect()->back()->with('error', 'Invalid credentials!');
    }

    }
}
