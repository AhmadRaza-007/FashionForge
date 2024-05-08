<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Clothe;
use App\Models\Order;
use App\Models\SubCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Input\Input;

use function PHPUnit\Framework\isNull;

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
        $cookie = cookie('active', 'dashboard', 60 * 24 * 30);
        // Return the view with the cookie attached to the response
        return response()->view('admin.main')->withCookie($cookie);
    }

    public function frontLogin()
    {
        return view('Layouts.auth.login');
    }

    public function frontSignup()
    {
        return view('Layouts.auth.signup');
    }

    public function postFrontLogin(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credentials = array_merge($data, ['user_type' => 2]);
        if (Auth::attempt($credentials)) {
            toastr()->addSuccess('Login Successfully');
            return redirect()->intended();
        }
        toastr()->closeButton(true)->closeHtml('⛑')->addError('Something Went Wrong');
        return redirect()->back()->withInput();
    }

    public function postFrontSignup(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'second_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);


        User::create([
            'first_name' => $request->first_name,
            'second_name' => $request->second_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.login');
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

    public function setTheme(Request $request)
    {
        if ($request->theme === 'on') {
            $cookie = cookie('theme', 'light', 60 * 24 * 30);
        } else {
            $cookie = cookie('theme', 'dark', 60 * 24 * 30);
        }
        return redirect()->back()->withCookie($cookie);
    }

    public function userProfile()
    {
        return view('Layouts.profile.index');
    }

    public function userEdit()
    {
        return view('Layouts.profile.editProfile');
    }

    public function userUpdate(Request $request)
    {
        // return isNull($request->address);

        if (empty($request->address) && empty($request->phone)) {
            $user = User::find(auth()->user()->id);
            $user->update([
                'first_name' => $request->first_name,
                'second_name' => $request->second_name,
                'email' => $request->second_name,
            ]);
        } else {
            $user = User::find(auth()->user()->id);
            $address = Address::where('user_id', auth()->user()->id)->first();

            $user->update([
                'first_name' => $request->first_name,
                'second_name' => $request->second_name,
                'email' => $request->email,
            ]);

            $address->update([
                'address' => $request->address,
                'phone' => $request->phone
            ]);
        }

        return redirect()->route('user.profile');
    }

    public function orders()
    {
        $currentOrders = Order::with('clothe')
            ->where('user_id', auth()->user()->id)
            ->where('order_status', '!=', 'Delivered')
            ->get();
        return view('Layouts.profile.orders', compact('currentOrders'));
    }

    public function ordersHistory()
    {
        $completedOrders = Order::with('clothe')
            ->where('user_id', auth()->user()->id)
            ->where('order_status', '=', 'Delivered')
            ->get();

        return view('Layouts.profile.history', compact('completedOrders'));
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
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
