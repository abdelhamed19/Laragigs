<?php
namespace App\Http\Controllers;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function showregister()
    {
        return view("users.register");
    }
    public function SaveRegisterInfo(Request $request)
    {
        $formFields= $request->validate([
            "name"=>["required","min:2"],
            "email"=> ['required', 'email',Rule::unique('users', 'email')],
            "password"=>["required","confirmed","min:6"]
        ]);
        $formFields['passowrds']=bcrypt($formFields['password']);
        auth()->login(User::create($formFields));
        return redirect("/")->with("User Created Seccufully");

    }
    public function showlogin()
    {
        return view("users.login");
    }
    public function login(Request $request)
    {
        $formFields= $request->validate([
            "email"=> ['required', 'email'],
            "password"=>["required"]
        ]);
        if (auth()->attempt($formFields))
        {
            $request->session()->regenerate();
            return redirect("/");
        }
        return back()->withErrors(['email'=>'invalid Inputs'])->onlyInput('email');
    }
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("/");
    }
}
