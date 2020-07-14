<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Mail\VerifyEmail;
use Mail;
use Session;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;

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
    protected $redirectTo = '/cabinet';

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
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        Session::flash('flash_message', trans('auth.registration_successful'));
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'confirmed' => 0, //Не подтвержден
            'verify_token' => Str::random(32),
        ]);
        $thisUser = User::findOrFail($user->id); //var_dump($thisUser); die;
        $this->sendEmail($thisUser);

        return $user;
    }

    /**
     * Переопределяем метод с trait класса
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return redirect(route('login'));

    }

    public function sendEmail($thisUser){

        Mail::to($thisUser['email'])->send(new VerifyEmail($thisUser));
    }

    public function sendEmailDone($email, $verifyToken){

        $user = User::where(['email' => $email, 'verify_token' => $verifyToken])->first();
        if($user){
            User::where(['email' => $email, 'verify_token' => $verifyToken])->update(['confirmed' => '1', 'verify_token' => null]);
            return redirect(route('login'))->with('success', trans('auth.activation_successful'));
        } else {
            return redirect(route('login'))->with('error', trans('auth.activation_error'));
        }
    }
}
