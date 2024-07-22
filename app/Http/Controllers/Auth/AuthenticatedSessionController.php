<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\file;
class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
          $image='/image/login.jpg';
        return view('auth.login',['image'=>$image]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {

        $request->authenticate();

        $request->session()->regenerate();
    if($request->user()->role==='admin'){
//    $files = file::all();
  //  dd($files);
  //  return view('Admin.dashboard', ['files' => $files]);
      return redirect()->route('admin.dashbared');
    }
    else{
      if($request->user()->status==='approve'){
          return redirect()->route('user.dash');
      }
      else{
        return view('auth.login');
      }
      }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
