<?php

namespace App\Http\Controllers;

use App\Models\Clothe;
use App\Models\SubCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Input\Input;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function slug($slug)
    {
        return $slug;
    }

    public function index()
    {
        return view('Layouts.home');
    }

    public function dashboard()
    {
        // return 'hello';
        return view('admin.main');
    }

    public function login()
    {
        return view('admin.login');
    }

    public function postLogin(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'user_type' => 1
        ];

        // User::create([
        //     'first_name' => 'Ahmad',
        //     'second_name' => 'Raza',
        //     'email' => 'admin@admin.com',
        //     'password' => Hash::make('125@0ab%'),
        // ]);

        if ($data) {
            if (Auth::attempt($credentials)) {
                return redirect('admin/dashboard');
            }
        }
        return redirect()->back()->withInput();
    }

    public function postLogout(Request $request)
    {
        $request->session()->invalidate();
        Auth::logout();
        return redirect('admin/login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
