<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegistrationController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {
        return view('register');
    }

    public function validateForm(Request $request) {

        $validator = $this->fetchValidator($request->all(), $request->input('check_for'));
        if ($validator === false) {
            return response()->json([
                'status'    => 'fail',
                'message'   => 'Invalid key to check for.'
            ]);
        }
        if ($validator->fails()) {
            return response()->json([
                'status'    => 'fail',
                'message'   => 'Validation failure.',
                'errors'    => $request->has('check_for') ? $validator->errors()->all() : $validator->errors()
            ]);
        }

        if ($request->has('check_for')) {
            return response()->json([
                'status'    => 'ok',
                'message'   => 'Values are ok'
            ]);
        }

        $user = new User;
        $user->first_name           = $request->input('first_name');
        $user->last_name            = $request->input('last_name');
        $user->email                = $request->input('email');
        $user->password             = bcrypt($request->input('password'));
        $user->date_of_birth        = $request->input('date_of_birth');
        $user->gender               = $request->input('gender');
        $user->annual_income        = $request->input('annual_income');
        $user->occupation           = $request->input('occupation');
        $user->family_type          = $request->input('family_type');
        $user->manglik              = $request->input('manglik');
        $user->expected_income      = $request->input('expected_income');
        $user->expected_occupation  = $request->input('expected_occupation');
        $user->expected_family_type = $request->input('expected_family_type');
        $user->expected_manglik     = $request->input('expected_manglik');
        $user->save();

        Auth::loginUsingId($user->id);

        return response()->json([
            'status'    => 'ok',
            'message'   => 'User registered.'
        ]);

    }

    /**
     * @param $inputs
     * @param null $key
     * @return bool|\Illuminate\Contracts\Validation\Validator
     */
    protected function fetchValidator($inputs, $key = null) {
        if ($key !== null && $this->fetchRule($key) === false) {
            // Rule not present. Invalid input parameter.
            return false;
        }
        return Validator::make(
            $inputs,
            $key !== null
                ? $this->fetchRule($key)
                : $this->rules(),
            $this->messages()
        );
    }

    private function rules() {
        return [
            'first_name'                => 'required|alpha|max:255',
            'last_name'                 => 'required|alpha|max:255',
            'email'                     => 'required|email:filter|unique:users,email',
            'password'                  => 'required|min:8',
            'password_confirmation'     => 'required|same:password',
            'date_of_birth'             => 'required|date|before_or_equal:' . now()->subYears(18)->toDateString(),
            'gender'                    => 'required|in:male,female',
            'annual_income'             => 'required|gte:0|lte:10000000',
            'occupation'                => ['nullable', Rule::in(['private job', 'government job', 'business'])],
            'family_type'               => ['nullable', Rule::in(['joint family', 'nuclear family'])],
            'manglik'                   => 'nullable|in:yes,no',
            'expected_income.min'       => 'nullable|numeric|gte:0|lte:expected_income.max',
            'expected_income.max'       => 'nullable|numeric|gte:expected_income.min|lte:10000000',
            'expected_occupation'       => 'nullable|array',
            'expected_occupation.*'     => [Rule::in(['private job', 'government job', 'business'])],
            'expected_family_type'      => 'nullable|array',
            'expected_family_type.*'    => [Rule::in(['joint family', 'nuclear family'])],
            'expected_manglik'          => 'nullable|in:yes,no,both'
        ];
    }

    /**
     * @param $key
     * @return array|bool
     */
    protected function fetchRule($key) {
        if (!isset($this->rules()[$key])) {
            return false;
        }
        return [$key => $this->rules()[$key]];
    }

    /**
     * @return array
     */
    private function messages() {
        return [
            'first_name.required'           => 'First name is required.',
            'first_name.alpha'              => 'First name must be alphabetical characters only.',
            'first_name.max'                => 'First name cannot be more than 255 characters.',
            'last_name.required'            => 'Last name is required.',
            'last_name.alpha'               => 'Last name must be alphabetical characters only.',
            'last_name.max'                 => 'Last name cannot be more than 255 characters.',
            'email.required'                => 'E-Mail is required.',
            'email.email'                   => 'Please provide a valid e-mail address.',
            'email.unique'                  => 'Account already exists with this e-mail.',
            'password.required'             => 'Password is required.',
            'password.min'                  => 'Password must be at least 8 characters.',
//            'password.confirmed'            => 'Passwords do not match.',
            'password_confirmation.same'    => 'Password confirmation is required.',
            'password_confirmation.same'    => 'Passwords do not match.',
            'date_of_birth.required'        => 'Date of birth is required.',
            'date_of_birth.date'            => 'Please provide a valid date.',
            'date_of_birth.before_or_equal' => 'You must be at least 18 years old to register to this website.',
            'gender.required'               => 'Gender is required.',
            'gender.in'                     => 'Gender can be either male or female.',
            'annual_income.required'        => 'Annual income is required.',
            'annual_income.gte'             => 'Annual income must be greater than or equal to 0.',
            'annual_income.lte'             => 'Annual income must be less than or equal to 10,000,000.',
//            'occupation.nullable'           => 'Occupation is optional.',
            'occupation.in'                 => 'Occupation can only be any one of "Private job", "Government job" and "Business".',
            'family_type.family_type'       => 'Family type is optional.',
            'family_type.in'                => 'Family type can only be either "Joint family" or "Nuclear family".',
//            'manglik.nullable'              => 'Manglik is optional.',
            'manglik.in'                    => 'Manglik must be either "Yes" or "No".',
//            'expected_income.min.nullable'  => 'Expected income\'s lower end is optional.',
            'expected_income.min.numeric'   => 'Expected income\'s lower end must be numeric.',
            'expected_income.min.gte'       => 'Expected income\'s lower end must be greater than or equal to 0.',
            'expected_income.min.lte'       => 'Expected income\'s lower end must be less than or equal to expected income\'s upper end.',
//            'expected_income.max.nullable'  => 'Expected income\'s upper end is optional.',
            'expected_income.max.numeric'   => 'Expected income\'s upper end must be numeric.',
            'expected_income.max.gte'       => 'Expected income\'s upper end must be greater than or equal to expected income\'s lower end.',
            'expected_income.max.lte'       => 'Expected income\'s lower end must be less than or equal to 10,000,000.',
//            'expected_occupation.nullable'  => 'Expected occupation is optional.',
            'expected_occupation.array'     => 'Expected occupation must be an array.',
            'expected_occupation.*.in'      => 'Expected occupations selected can only be "Private job", "Government job" and "Business".',
//            'expected_family_type.nullable' => 'Expected family type is optional.',
            'expected_family_type.array'    => 'Expected family type must be an array.',
            'expected_family_type.*.in'     => 'Expected family type selected can be "Joint family" or "Nuclear family".',
//            'expected_manglik.nullable'     => 'Expected manglik is optional.',
            'expected_manglik.in'           => 'Expected manglik can only be any one in "Yes", "No" and "Both".',
        ];
    }

    /**
     * @param $key
     * @return array
     */
    protected function fetchMessages($key) {
        $allMessages = $this->messages();
        $keys = array_values(preg_grep("/$key/", $allMessages));
        if (count($keys) === 0) {
            return [];
        }
        $messages = [];
        foreach ($keys as $key) {
            $messages[$key] = $allMessages[$key];
        }
        return $messages;
    }

}
