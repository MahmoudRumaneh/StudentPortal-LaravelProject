<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    protected function validator(array $data)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/'],
        ];
        if (!empty($data['phone'])) {
            $rules['phone'] = ['required', 'string', 'regex:/^(78|77|79)\d{7}$/', 'max:9'];
        }
        return Validator::make($data, $rules, [
            'name.unique' => 'Username already taken.',
            'email.unique' => 'Email already taken.',
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'password.confirmed' => 'Passwords do not match.',
            'phone.regex' => 'Phone number must start with 78, 77, or 79 and be 9 digits at most.',
        ]);
    }


    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json(['errors' => $errors], 422);
        }

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'type' => 'student',
            'active' => false,

            'phone' => $request->phone ?? "000000000",
            'address' => $request->address ?? "No Address Available",
            'national_number' => $request->national_number ?? "0000000000",
        ];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images'); // Store the image in the 'images' directory
            $userData['image'] = Storage::url($imagePath); // Get the URL of the stored image
        } else {
            $userData['image'] = 'https://static.thenounproject.com/png/1270115-200.png';
        }

        $user = User::create($userData);

        if (Auth::check() && Auth::user()->type === 'admin') {
            return redirect()->route('adminHomePage')->with('success', 'Registration successful!');
        } else {
            return redirect('/')->with('success', 'Registration successful!');
        }
    }
}
