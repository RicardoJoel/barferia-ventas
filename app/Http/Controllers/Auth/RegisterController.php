<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\DocumentType;
use App\DependentType;
use App\Dependent;
use App\Parameter;
use App\Gender;
use App\Ubigeo;
use App\User;
use Redirect;
use DB;

class RegisterController extends Controller
{
    protected const MSG_SCS_RGTUSR = 'Usuario con código value creado satisfactoriamente. En breve, el usuario recibirá un correo para activar su cuenta.';
    protected const MSG_ERR_CRTDEP = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar un dependiente.';

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
    protected $redirectTo = 'admin/users';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('is_admin');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $maxsal = Parameter::where('name','MAXSAL')->get()->first()->value;
        $needed = isset($data['profile_id']) && $data['profile_id'] == 5 ? 'required' : 'nullable';

        return Validator::make($data, [
            'name' => 'required|string|max:50|regex:/^[\pL\s\-]+$/u',
            'lastname' => 'required|string|max:50|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email:rfc|max:50|unique:users,email,NULL,id,deleted_at,NULL',
            'document_type_id' => 'required|integer|min:1',
            'document' => 'required|string|unique:users,document,NULL,id,deleted_at,NULL|regex:/'.$data['doc_pattern'].'/',
            'gender_id' => 'required|integer|min:1',
            'birthdate' => 'required|date|date_format:Y-m-d|before_or_equal:-18 years',
            'address' => 'required|string|max:100',
            'ubigeo' => 'required|string|max:300',
            'country_id' => 'required|integer|min:1',
            'mobile' => 'required|string|regex:/[0-9]{3} [0-9]{3} [0-9]{3}/',
            'phone' => 'nullable|string|regex:/[0-9]{2} [0-9]{3} [0-9]{4}/',
            'annex' => 'nullable|string|regex:/[0-9]{4,6}/',
            'alt_email' => 'nullable|email:rfc|min:8|max:50',
            'relationship_id' => 'required|integer|min:1',
            'profile_id' => 'required|integer|min:1',
            'center_id' => 'integer|min:1|'.$needed,
            'str_salary' => 'nullable|numeric|between:0,'.$maxsal,
            'commission' => 'nullable|numeric|between:0,100',
            'frequency_id' => 'nullable|integer|min:1',
            'start_at' => 'nullable|date|date_format:Y-m-d',
            'end_at' => 'nullable|date|date_format:Y-m-d|after_or_equal:start_at|before_or_equal:today',
            'bank_id' => 'nullable|integer|min:1',
            'bank_account' => 'nullable|string|max:20',
            'cci' => 'nullable|string|max:23',
            'afp_id' => 'nullable|integer|min:1',
            'commission_id' => 'nullable|integer|min:1',
            'cuspp' => 'nullable|string|max:12',
            'cts_id' => 'nullable|integer|min:1',
            'cts_account' => 'nullable|string|max:20',
            'eps_id' => 'nullable|integer|min:1', 
            'essalud' => 'nullable|string|max:15',
            'contact_fullname' => 'nullable|string|max:50|regex:/^[\pL\s\-]+$/u',
            'contact_relationship' => 'nullable|string|max:50|regex:/^[\pL\s\-]+$/u',
            'contact_address' => 'nullable|string|max:100',
            'contact_ubigeo' => 'nullable|string|max:300',
            'contact_country_id' => 'nullable|integer|min:1',
            'contact_mobile' => 'nullable|string|regex:/[0-9]{3} [0-9]{3} [0-9]{3}/',
            'contact_phone' => 'nullable|string|regex:/[0-9]{2} [0-9]{3} [0-9]{4}/',
            'contact_annex' => 'nullable|string|regex:/[0-9]{4,6}/'
        ], UserController::validationErrorMessages());
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        $dependents = session('dependents', []);
        foreach ($dependents as $dependent) {
            if (!Dependent::create([
                'name' => $dependent['name'],
                'lastname' => $dependent['lastname'],
                'dependent_type_id' => DependentType::where('name',$dependent['type'])->get()->first()->id,
                'document_type_id' => DocumentType::where('name',$dependent['document_type'])->get()->first()->id,
                'document' => $dependent['document'],
                'gender_id' => Gender::where('name',$dependent['gender'])->get()->first()->id,
                'birthdate' => $dependent['birthdate'],
                'user_id' => $user->id
            ]))
                return Redirect::back()->with('error', self::MSG_ERR_CRTDEP)->withInput();
        }
        session()->forget('dependents');
        $request->session()->flash('success', str_replace('value',$user->code,self::MSG_SCS_RGTUSR));
    }
    
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $ubigeo = Ubigeo::where(DB::raw('concat(department," / ",province," / ",district)'),$request->ubigeo)->get()->first()->id ?? null;
        $other = $ubigeo ? null : $request->ubigeo;
        
        $contact_ubigeo = Ubigeo::where(DB::raw('concat(department," / ",province," / ",district)'),$request->contact_ubigeo)->get()->first()->id ?? null;
        $contact_other = $contact_ubigeo ? null : $request->contact_ubigeo;
        
        if ($request->profile_id != 5) $request['center_id'] = null;

        event(new Registered($user = User::create($request->all() + ['ubigeo_id' => $ubigeo, 'other_ubigeo' => $other, 'contact_ubigeo_id' => $contact_ubigeo, 'contact_other_ubigeo' => $contact_other])));

        if ($response = $this->registered($request, $user)) return $response;

        return $request->wantsJson()
                    ? new Response('', 201)
                    : redirect($this->redirectPath());
    }
}