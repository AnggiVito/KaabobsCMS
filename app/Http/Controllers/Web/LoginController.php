<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->intended('/dashboard');
        }
        return view('login/index');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $role = Auth::user()->role;

            $menus = Menu::where('status', 'ACTIVE')
                ->whereHas('menu_role_mapping', function ($query) use ($role) {
                    $query->where('code_role', $role);
                })
                ->with(['menu_sub' => function ($query) use ($role) {
                    $query->where('status', 'ACTIVE')
                            ->whereHas('menu_role_mapping', function ($subQuery) use ($role) {
                                $subQuery->where('code_role', $role);
                            })
                            ->orderBy('id', 'ASC');
                }])
                ->orderBy('urutan', 'ASC')
                ->get();
            Session::put('menu', $menus);
            return redirect()->intended('dashboard');
        }
        return back()->with('loginError','Username atau Password salah.')->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function profile(Request $request)
    {
        $data = [
            'title' => 'Profile',
            'subTitle' => '',
            'pegawai' => Auth::user()
        ];
        return view('login/profile', $data);
    }
}