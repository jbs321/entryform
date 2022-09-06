<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname'        => 'required|string|max:255',
            'lname'        => 'required|string|max:255',
            'email'        => 'required|string|email|max:255|unique:users',
            'password'     => 'required|string|min:6|confirmed',
            'address'      => 'required|string|max:255',
            'city'         => 'required|string|max:255',
            'province'     => 'required|string|max:100',
            'postal_code'  => 'required|string|max:50',
            'phone_number' => 'required|string|max:50',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     *
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'fname'        => $data['fname'],
            'lname'        => $data['lname'],
            'email'        => $data['email'],
            'address'      => $data['address'],
            'city'         => $data['city'],
            'province'     => $data['province'],
            'postal_code'  => $data['postal_code'],
            'phone_number' => $data['phone_number'],
            'password'     => Hash::make($data['password']),
        ]);
    }

    /**
     * Hides the registration page
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function showRegistrationForm()
    {
        if(env('ENTRYFORM_REGISTRATION', 1)) {
            return view('auth.register');
        }

        return redirect('login');
    }
}
