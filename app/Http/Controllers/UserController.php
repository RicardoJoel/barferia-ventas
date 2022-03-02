<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use App\User;
use App\Ubigeo;
use App\Gender;
use App\Profile;
use App\DocumentType;
use App\Dependent;
use App\DependentType;
use App\Parameter;
use App\Variation;
use Carbon\Carbon;
use Redirect;
use Auth;
use DB;

class UserController extends Controller
{
    protected const MSG_SCS_ACTIVE = 'Tu cuenta fue activada con éxito.';
    protected const MSG_SCS_UPDACC = 'Tus datos se actualizaron de manera exitosa.';
    protected const MSG_ERR_UPDACC = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar tus datos.';
    protected const MSG_NOT_FOUNDX = 'El usuario solicitado no ha sido encontrado.';
    
    protected const MSG_SCS_UPDUSR = 'El usuario con código value fue actualizado de manera exitosa.';
    protected const MSG_ERR_UPDUSR = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar el usuario.';
    protected const MSG_SCS_DELUSR = 'El usuario con código value fue eliminado de manera exitosa.';
    protected const MSG_ERR_DELUSR = 'Lo sentimos, ocurrió un problema mientras se intentaba eliminar el usuario.';
    
    protected const MSG_SCS_CRTDEP = 'Dependiente con código value registrado de manera exitosa.';
    protected const MSG_ERR_CRTDEP = 'Lo sentimos, ocurrió un problema mientras se intentaba registrar un dependiente.';
    protected const MSG_SCS_UPDDEP = 'Dependiente con código value actualizado de manera exitosa.';
    protected const MSG_ERR_UPDDEP = 'Lo sentimos, ocurrió un problema mientras se intentaba actualizar un dependiente.';
    protected const MSG_SCS_DELDEP = 'Dependiente con código value eliminado de manera exitosa.';
    protected const MSG_ERR_DELDEP = 'Lo sentimos, ocurrió un problema mientras se intentaba eliminar un dependiente.';
    protected const MSG_NOT_FNDDEP = 'El dependiente solicitado no ha sido encontrado.';

    protected const MSG_NOT_SALRNG = 'El sueldo resultante no puede ser negativo ni mayor a value soles.';
    protected const MSG_NOT_UNIQUE = 'Solo puedes agregar una variación salarial a la vez.';
    protected const MSG_BTW_MONTHS = 'No puedes agregar una variación salarial cuya fecha efectiva sea anterior a la última ingesada más value mes(es).';
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id','!=',1)->orderBy('code')->paginate(1000000);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (session()->has('errors')) {
            $dependents = session('dependents', []);
        }
        else {
            $dependents = [];
            session(['dependents' => $dependents]);
        }
        return view('users.create', compact('dependents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        
        if (!$user) 
            return Redirect::back()->with('error', self::MSG_NOT_FOUNDX);

        if (session()->has('errors')) {
            $dependents = session('dependents', []);
            $variations = session('variations', []);
        }
        else {
            $dependents = [];
            foreach ($user->dependents as $dependent) {
                $dependents[] = [
                    'id' => $dependent->id,
                    'name' => $dependent->name,
                    'lastname' => $dependent->lastname,
                    'type' => DependentType::find($dependent->dependent_type_id)->name,
                    'document_type' => DocumentType::find($dependent->document_type_id)->name,
                    'document' => $dependent->document,
                    'gender' => Gender::find($dependent->gender_id)->name,
                    'birthdate' => $dependent->birthdate
                ];
            }
            $variations = $user->variations;
            session(['dependents' => $dependents, 'variations' => $variations]);
        }
        return view('users.edit', compact('user','dependents','variations'));
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
        $maxsal = Parameter::where('name','MAXSAL')->get()->first()->value;
        $months = Parameter::where('name','MONTHS')->get()->first()->value;
        $needed = isset($data['profile_id']) && $data['profile_id'] == 5 ? 'required' : 'nullable';

        self::validate($request, [
            'name' => 'required|string|max:50|regex:/^[\pL\s\-]+$/u',
            'lastname' => 'required|string|max:50|regex:/^[\pL\s\-]+$/u',
            'birthdate' => 'required|date|date_format:Y-m-d|before_or_equal:-18 years',
            'document_type_id' => 'required|integer|min:1',
            'document' => 'required|string|unique:users,document,'.$id.',id,deleted_at,NULL|regex:/'.$request->doc_pattern.'/',
            'gender_id' => 'required|integer|min:1',
            'email' => 'required|email:rfc|max:50|unique:users,email,'.$id.',id,deleted_at,NULL',
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
        ], self::validationErrorMessages());

        $user = User::find($id);
        
        if (!$user) 
            return Redirect::back()->with('error', self::MSG_NOT_FOUNDX)->withInput();

        $variations = session('variations', []);
        $ultimo = [
            'start_at' => '1900-01-01',
            'after' => $user->cur_salary ?? 0
        ];
        $cnt = 0;
        foreach ($variations as $variat)
            if ($variat['id'] === '') {
                $new = $variat;
                $cnt++;
            }
            else {
                $var = Carbon::parse($variat['start_at']);
                $ult = Carbon::parse($ultimo['start_at']);
                if ($var->gt($ult)) $ultimo = $variat;
            }
        /* Ini: registro unico */
        if ($cnt > 1)
            return Redirect::back()->with('error', self::MSG_NOT_UNIQUE)->withInput();
        /* Fin: registro unico */
        if ($cnt > 0) {
            /* Ini: dentro de meses */
            $var = Carbon::parse($new['start_at']);
            $ult = Carbon::parse($ultimo['start_at']);
            if ($var->lt($ult->addMonths($months)))
                return Redirect::back()->with('error', str_replace('value',$months,self::MSG_BTW_MONTHS))->withInput();
            /* Fin: dentro de meses */

            if ($new['type'] === 'Aumento')
                $new_salary = $ultimo['after'] + $new['amount'];
            else
                $new_salary = $ultimo['after'] - $new['amount'];

            if ($new_salary < 0 || $new_salary > $maxsal)
                return Redirect::back()->with('error', str_replace('value',number_format($maxsal),self::MSG_NOT_SALRNG))->withInput();
            
            if (!Variation::create([
                'type' => $new['type'],
                'amount' => $new['amount'],
                'start_at' => $new['start_at'],
                'observation' => $new['observation'],
                'before' => $ultimo['after'],
                'after' => $new_salary,
                'user_id' => $user->id
            ])) 
                return Redirect::back()->with('error', self::MSG_ERR_UPDUSR)->withInput();
            
            if (Carbon::parse($new['start_at'])->lte(Carbon::today()))
                $request['cur_salary'] = $new_salary;
        }
        session()->forget('variations');
    
        $dependents = session('dependents', []);
        foreach ($user->dependents as $dependent) {
            if (!self::inArray($dependent->id, $dependents))
                $dependent->delete();
        }

        foreach ($dependents as $dependent) {
            if ($dependent['id']) { //Dependiente actualmente registrado
                if (!Dependent::find($dependent['id'])->update([
                    'name' => $dependent['name'],
                    'lastname' => $dependent['lastname'],
                    'dependent_type_id' => DependentType::where('name',$dependent['type'])->get()->first()->id,
                    'document_type_id' => DocumentType::where('name',$dependent['document_type'])->get()->first()->id,
                    'document' => $dependent['document'],
                    'gender_id' => Gender::where('name',$dependent['gender'])->get()->first()->id,
                    'birthdate' => $dependent['birthdate'],
                    'user_id' => $user->id
                ]))
                    return Redirect::back()->with('error', self::MSG_ERR_UPDDEP)->withInput();
            }
            else { //Dependiente sin registrar
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
        }
        session()->forget('dependents');
        
        $ubigeo = Ubigeo::where(DB::raw('concat(department," / ",province," / ",district)'),$request->ubigeo)->get()->first()->id ?? null;
        $other = $ubigeo ? null : $request->ubigeo;
        
        $contact_ubigeo = Ubigeo::where(DB::raw('concat(department," / ",province," / ",district)'),$request->contact_ubigeo)->get()->first()->id ?? null;
        $contact_other = $contact_ubigeo ? null : $request->contact_ubigeo;

        if ($request->profile_id != 5) $request['center_id'] = null;

        $result = $user->update($request->all() + ['ubigeo_id' => $ubigeo, 'other_ubigeo' => $other, 'contact_ubigeo_id' => $contact_ubigeo, 'contact_other_ubigeo' => $contact_other]);
        $cambio = false;

        if ($result && !$request->end_at) {
            $user->end_at = NULL;
            $cambio = true;
        }
        if ($result && !$request->commission_id) {
            $user->commission_id = NULL;
            $cambio = true;
        }
        if ($result && !$request->cuspp) {
            $user->cuspp = NULL;
            $cambio = true;
        }
        if ($result && !$request->cts_account) {
            $user->cts_account = NULL;
            $cambio = true;
        }
        if ($result && $cambio) {
            $result = $user->save();
        }
        if (!$result)
            return Redirect::back()->with('error', self::MSG_ERR_UPDUSR)->withInput();

        return Redirect::route('users.index')->with('success',str_replace('value',$user->code,self::MSG_SCS_UPDUSR));        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        
        if (!$user) 
            return Redirect::back()->with('error', self::MSG_NOT_FOUNDX);

        foreach ($user->dependents as $dependent)
            if (!$dependent->delete())
                return Redirect::back()->with('error', self::MSG_ERR_DELDEP);

        if (!$user->delete())
            return Redirect::back()->with('error', self::MSG_ERR_DELUSR);
        
        return Redirect::route('users.index')->with('success',str_replace('value',$user->code,self::MSG_SCS_DELUSR));
    }

    public function activate($code)
    {
        $users = User::where('confirmation_code',$code);
        $exist = $users->count();
        $user = $users->first();
        if ($exist == 1 and $user->email_verified_at == NULL) {
            $id = $user->id;
            $email = $user->email;
            return view('auth.date_complete',compact('id', 'email'));
        }
        else
            return Redirect::route('login');
    }

    public function complete(UserRequest $request, $id)
    {
        $request->validate([
            'password' => 'required|between:8,20|different:email',
            'password_confirmation' => 'same:password'
        ], self::validationErrorMessages());
        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->email_verified_at = now();
        $user->save();
        return Redirect::route('login')->with('status',self::MSG_SCS_ACTIVE);
    }

    public function updateAccount(Request $request)
    {
        self::validate($request, [
            'name' => 'required|string|max:50|regex:/^[\pL\s\-]+$/u',
            'lastname' => 'required|string|max:50|regex:/^[\pL\s\-]+$/u',
            'birthdate' => 'required|date|date_format:Y-m-d|before_or_equal:-18 years',
            'gender_id' => 'required|integer|min:1',
            'address' => 'required|string|max:100',
            'ubigeo' => 'required|string|max:300',
            'country_id' => 'required|integer|min:1',
            'mobile' => 'required|string|regex:/[0-9]{3} [0-9]{3} [0-9]{3}/',
            'phone' => 'nullable|string|regex:/[0-9]{2} [0-9]{3} [0-9]{4}/',
            'annex' => 'nullable|string|regex:/[0-9]{4,6}/',
            'alt_email' => 'nullable|email:rfc|min:8|max:50',
            'contact_fullname' => 'nullable|string|max:50|regex:/^[\pL\s\-]+$/u',
            'contact_relationship' => 'nullable|string|max:50|regex:/^[\pL\s\-]+$/u',
            'contact_address' => 'nullable|string|max:100',
            'contact_ubigeo' => 'nullable|string|max:300',
            'contact_country_id' => 'nullable|integer|min:1',
            'contact_mobile' => 'nullable|string|regex:/[0-9]{3} [0-9]{3} [0-9]{3}/',
            'contact_phone' => 'nullable|string|regex:/[0-9]{2} [0-9]{3} [0-9]{4}/',
            'contact_annex' => 'nullable|string|regex:/[0-9]{4,6}/'
        ], self::validationErrorMessages());
        
        $ubigeo = Ubigeo::where(DB::raw('concat(department," / ",province," / ",district)'),$request->ubigeo)->get()->first()->id ?? null;
        $other = $ubigeo ? null : $request->ubigeo;
        
        $contact_ubigeo = Ubigeo::where(DB::raw('concat(department," / ",province," / ",district)'),$request->contact_ubigeo)->get()->first()->id ?? null;
        $contact_other = $contact_ubigeo ? null : $request->contact_ubigeo;

        if (!Auth::user()->update($request->all() + ['ubigeo_id' => $ubigeo, 'other_ubigeo' => $other, 'contact_ubigeo_id' => $contact_ubigeo, 'contact_other_ubigeo' => $contact_other]))
            return Redirect::back()->with('error',self::MSG_ERR_UPDACC)->withInput();

        return Redirect::back()->with('success',self::MSG_SCS_UPDACC);
    }

    public function getByDocument($doc) {
        $users = User::where('document',$doc)->get(['id','code',DB::raw('concat(lastname,", ",name) as name')]);
        if (!count($users)) return null;
        return $users->first();
    }

    public function getByMobile($mob) {
        $users = User::where('mobile',$mob)->get(['id','code',DB::raw('concat(lastname,", ",name) as name')]);
        if (!count($users)) return null;
        return $users->first();
    }

    public function searchByFilter(Request $request) {
        $code = $request->user_code;
        $name = $request->user_name;
        $email = $request->user_email;
        $document = $request->user_doc;
        $mobile = $request->user_mobile;
        $document_type_id = $request->user_doc_type_id;

        $users = User::select([
            DB::raw('users.id as id'),
            DB::raw('users.code as code'),
            DB::raw('concat(users.lastname,", ",users.name) as name'),
            DB::raw('users.email as email'),
            DB::raw('document_types.name as documentType'),
            DB::raw('users.document as document'),
            DB::raw('concat(countries.code," ",users.mobile) as mobile'),
        ])
        ->leftJoin('document_types','document_types.id','users.document_type_id')
        ->leftJoin('countries','countries.id','users.country_id')
        ->where('users.id','!=',1)
        ->whereNull('users.end_at')
        ->where(DB::raw('ifnull(users.code,"")'),'like','%'.$code.'%')
        ->where(DB::raw('concat(ifnull(users.name,"")," ",ifnull(users.lastname,""))'),'like','%'.$name.'%')
        ->where(DB::raw('ifnull(users.email,"")'),'like','%'.$email.'%')
        ->where(DB::raw('ifnull(users.document,"")'),'like','%'.$document.'%')
        ->where(DB::raw('ifnull(users.mobile,"")'),'like','%'.$mobile.'%')
        ->where(function ($query) use ($document_type_id) {
            if ($document_type_id)
                $query->where('users.document_type_id',$document_type_id);
            return $query;
        })
        ->get();

        return json_encode($users);
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    public static function validationErrorMessages()
    {
        $maxsal = Parameter::where('name','MAXSAL')->get()->first()->value;

        return [
            'name.required' => 'Debes ingresar obligatoriamente un nombre.',
            'name.regex' => 'El nombre debe incluir únicamente letras y espacios en blanco entre palabras.',
            'name.max' => 'El nombre no debe superar los cincuenta (50) caracteres.',

            'lastname.required' => 'Debes ingresar obligatoriamente un apellido.',
            'lastname.regex' => 'El apellido debe incluir únicamente letras y espacios en blanco entre palabras.',
            'lastname.max' => 'El apellido no debe superar los cincuenta (50) caracteres.',
            
            'email.required' => 'Debes ingresar obligatoriamente un correo electrónico institucional.',
            'email.unique' => 'El correo electrónico institucional ingresado ya existe en el sistema.',
            'email.email' => 'El correo electrónico institucional ingresado no tiene un formato válido.',
            'email.max' => 'El correo electrónico institucional no debe superar los cincuenta (50) caracteres.',
            
            'document_type_id.required' => 'Debes ingresar obligatoriamente un tipo de documento.',
            'document_type_id.integer' => 'El ID del tipo de documento ingresado no tiene un formato válido.',
            'document_type_id.min' => 'El ID del tipo de documento ingresado no es válido.',

            'document.required' => 'Debes ingresar obligatoriamente un N° Documento.',
            'document.unique' => 'El N° Documento ingresado ya existe en el sistema.',
            'document.regex' => 'El N° Documento ingresado no corresponde al tipo de documento ingresado.',

            'gender_id.required' => 'Debes ingresar obligatoriamente un género.',
            'gender_id.integer' => 'El ID del género ingresado no tiene un formato válido.',
            'gender_id.min' => 'El ID del género ingresado no es válido.',

            'birthdate.required' => 'Debes ingresar obligatoriamente una fecha de nacimiento.',
            'birthdate.date' => 'La fecha de nacimiento ingresada no tiene un formato válido.',
            'birthdate.date_format' => 'La fecha de nacimiento ingresada no tiene un formato válido.',
            'birthdate.before_or_equal' => 'La fecha de nacimiento ingresada no corresponde a una persona con mayoría de edad.',

            'address.required' => 'Debes ingresar obligatoriamente una dirección de domicilio.',
            'address.max' => 'La dirección de domicilio no debe superar los cien (100) caracteres.',
            
            'ubigeo.required' => 'Debes ingresar obligatoriamente un departamento / provincia / distrito de domicilio.',
            'ubigeo.max' => 'El departamento / provincia / distrito de facturación no debe superar los trescientos (300) caracteres.',

            'country_id.required' => 'Debes ingresar obligatoriamente un código de país.',
            'country_id.integer' => 'El ID del código de país ingresado no tiene un formato válido.',
            'country_id.min' => 'El ID del código de país ingresado no es válido.',

            'mobile.required' => 'Debes ingresar obligatoriamente un número celular.',
            'mobile.regex' => 'El número celular debe estar compuesto por nueve (9) dígitos.',            
            'phone.regex' => 'El teléfono fijo debe estar compuesto por el código de ciudad seguido de seis (6) o siete (7) dígitos.',
            'annex.regex' => 'El anexo debe tener entre cuatro (4) y seis (6) dígitos.',
            
            'alt_email.email' => 'El correo electrónico personal ingresado no tiene un formato válido.',
            'alt_email.min' => 'El correo electrónico personal debe contener como mínimo ocho (8) caracteres.',
            'alt_email.max' => 'El correo electrónico personal no debe superar los cincuenta (50) caracteres.',

            'relationship_id.required' => 'Debes ingresar obligatoriamente un vínculo laboral.',
            'relationship_id.integer' => 'El ID del vínculo laboral ingresado no tiene un formato válido.',
            'relationship_id.min' => 'El ID del vínculo laboral ingresado no es válido.',

            'profile_id.required' => 'Debes ingresar obligatoriamente un cargo.',
            'profile_id.integer' => 'El ID del cargo ingresado no tiene un formato válido.',
            'profile_id.min' => 'El ID del cargo ingresado no es válido.',

            'center_id.required' => 'El cargo ingresado requiere especificar una tienda o centro de producción.',
            'center_id.integer' => 'El ID de tienda o centro de producción ingresado no tiene un formato válido.',
            'center_id.min' => 'El ID de tienda o centro de producción ingresado no es válido.',

            'str_salary.required' => 'Debes ingresar obligatoriamente un sueldo bruto.',
            'str_salary.numeric' => 'El sueldo bruto ingresado no tiene un formato válido.',
            'str_salary.between' => 'El sueldo bruto debe estar entre 0 y '.number_format($maxsal).' soles.',

            'commission.numeric' => 'La comisión ingresada no tiene un formato válido.',
            'commission.between' => 'La comisión debe estar entre 0 y 100 por ciento.',

            'frequency_id.required' => 'Debes ingresar obligatoriamente una variación salarial.',
            'frequency_id.integer' => 'El ID de la variación salarial ingresada no tiene un formato válido.',
            'frequency_id.min' => 'El ID de la variación salarial ingresada no es válido.',

            'start_at.required' => 'Debes ingresar obligatoriamente una fecha de inicio.',
            'start_at.date' => 'La fecha de inicio ingresada no tiene un formato válido.',
            'start_at.date_format' => 'La fecha de inicio ingresada no tiene un formato válido.',

            'end_at.date' => 'La fecha de cese ingresada no tiene un formato válido.',
            'end_at.date_format' => 'La fecha de cese ingresada no tiene un formato válido.',
            'end_at.after_or_equal' => 'La fecha de cese no puede ser anterior a la fecha de inicio.',
            'end_at.before_or_equal' => 'La fecha de cese no puede ser posterior a la fecha actual.',

            'bank_id.required' => 'Debes ingresar obligatoriamente una entidad bancaria Sueldo.',
            'bank_id.integer' => 'El ID de la entidad bancaria Sueldo ingresada no tiene un formato válido.',
            'bank_id.min' => 'El ID de la entidad bancaria Sueldo ingresada no es válido.',

            'bank_account.required' => 'Debes ingresar obligatoriamente un N° Cuenta Sueldo.',
            'bank_account.max' => 'El N° Cuenta Sueldo no debe superar los veinte (20) caracteres.',

            'cci.required' => 'Debes ingresar obligatoriamente un Código de Cuenta Interbancario.',
            'cci.max' => 'El Código de Cuenta Interbancario no debe superar los veintitrés (23) caracteres.',

            'afp_id.required' => 'Debes ingresar obligatoriamente una Adm. Fondo de pensiones.',
            'afp_id.integer' => 'El ID de la Adm. Fondo de pensiones ingresada no tiene un formato válido.',
            'afp_id.min' => 'El ID de la Adm. Fondo de pensiones ingresada no es válido.',

            'commission_id.required' => 'Debes ingresar obligatoriamente un tipo de comisión.',
            'commission_id.integer' => 'El ID del tipo de comisión ingresada no tiene un formato válido.',
            'commission_id.min' => 'El ID del tipo de comisión ingresada no es válido.',

            'cuspp.required' => 'Debes ingresar obligatoriamente un código CUSPP.',
            'cuspp.max' => 'El código CUSPP no debe superar los doce (12) caracteres.',

            'cts_id.required' => 'Debes ingresar obligatoriamente una entidad bancaria CTS.',
            'cts_id.integer' => 'El ID de la entidad bancaria CTS ingresada no tiene un formato válido.',
            'cts_id.min' => 'El ID de la entidad bancaria CTS ingresada no es válido.',

            'cts_account.required' => 'Debes ingresar obligatoriamente un N° Cuenta CTS.',
            'cts_account.max' => 'El N° Cuenta CTS no debe superar los quince (20) caracteres.',

            'eps_id.required' => 'Debes ingresar obligatoriamente un plan EPS.',
            'eps_id.integer' => 'El ID del plan EPS ingresado no tiene un formato válido.',
            'eps_id.min' => 'El ID del plan EPS ingresado no es válido.',

            'essalud.required' => 'Debes ingresar obligatoriamente un código Essalud.',
            'essalud.max' => 'El código Essalud no debe superar los quince (15) caracteres.',

            'contact_fullname.regex' => 'El nombre completo del contacto de emergencia debe incluir únicamente letras y espacios en blanco entre palabras.',
            'contact_fullname.max' => 'El nombre completo del contacto de emergencia no debe superar los cincuenta (50) caracteres.',            

            'contact_relationship.regex' => 'El parentesco del contacto de emergencia debe incluir únicamente letras y espacios en blanco entre palabras.',
            'contact_relationship.max' => 'El parentesco del contacto de emergencia no debe superar los cincuenta (50) caracteres.',            

            'contact_address.max' => 'La dirección del contacto de emergencia no debe superar los cien (100) caracteres.',
            'contact_ubigeo.max' => 'El distrito del contacto de emergencia no debe superar los trescientos (300) caracteres.',

            'contact_country_id.integer' => 'El ID del código país del contacto de emergencia ingresado no tiene un formato válido.',
            'contact_country_id.min' => 'El ID del código país del contacto de emergencia ingresado no es válido.',

            'contact_mobile.regex' => 'El número celular del contacto de emergencia debe estar compuesto por nueve (9) dígitos.',            
            'contact_phone.regex' => 'El teléfono fijo del contacto de emergencia debe estar compuesto por el código de ciudad seguido de seis (6) o siete (7) dígitos.',
            'contact_annex.regex' => 'El anexo del contacto de emergencia debe tener entre cuatro (4) y seis (6) dígitos.',
            
            'password.required' => 'Debes ingresar obligatoriamente una contraseña.',
            'password.between' => 'La contraseña debe contener entre 8 y 20 caracteres.',
            'password.different' => 'La contraseña no puede ser igual a tu correo electrónico.',
            'password_confirmation.same' => 'Las contraseñas ingresadas no coinciden.',
        ];
    }
}