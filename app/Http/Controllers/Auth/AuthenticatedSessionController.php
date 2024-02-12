<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Semester;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{

    protected $email;
    /**
     * Display the login view.
     */
    public function create(): View
    {

        $semester = Semester::with('tahunAjaran')->get();

        $semesterAktif = Semester::whereStatus(true)->first();
        return view('welcome', compact('semester', 'semesterAktif'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        $request->authenticate();

        session([
            'semester_id' => $request->semester,
        ]);

        if (Auth::user()->level == 'admin') {
            return redirect()->intended(RouteServiceProvider::HOME);
        } else {
            return redirect()->intended(RouteServiceProvider::STUDENT);
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
