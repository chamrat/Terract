<?php

namespace App\Http\Controllers\Auth;

use App\Invitation;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Role;

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
    protected $redirectTo = '/home';

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
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        try{
            $user = User::create([
                'firstName' => $data['firstName'],
                'lastName' => $data['lastName'],
                'telephone' => $data['telephone'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);

            if(isset($data['emailCode'])){
                $invitation = Invitation::where('email_code',$data['emailCode'])->first();
                $invitation->verified = true;
                $invitation->save();
                $user->propertyUnits()->attach($invitation->property_unit_id);
            }

            $user->roles()->attach($data['role']);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
        return $user;
    }

    public function showRegistrationForm()
    {
        $roleName = 'Landlord';
        $emailCode = '';
        if(isset($_GET['emailCode'])){
            $emailCode = $_GET['emailCode'];
            $roleName = 'Tenant';
            $invitationRaw  = Invitation::where('email_code',$emailCode)
                ->where('verified', false)
                ->get();
            $invitation = $invitationRaw->map(function ($invitationRaw){
                return collect($invitationRaw->toArray())
                    ->only('id', 'tenant_email', 'email_code')
                    ->all();
            });
            if(!$invitation->first()){
                $message = 'Wrong email code! please check with site admin';
                $msgClass = 'alert-warning';
                return view('common.error')
                    ->with(compact('message'))
                    ->with(compact('msgClass'));
            }
        }
        $role = Role::where('name', $roleName)->pluck('id', 'name')->first();
        return view('auth.register')
            ->with(compact('role'))
            ->with(compact('invitation'));
    }
}
