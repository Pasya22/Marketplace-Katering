<?php
namespace App\Http\Controllers;

use Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'login']);
    }

    public function index()
    {
        return view('auth.login.login');
    }
    public function register_user()
    {
        return view('auth.register.register');
    }
    public function register(Request $request)
    {
        // Validasi input
        try {
            $validated = $request->validate([
                'username' => 'required|unique:users|max:50',
                'password' => 'required|min:6|confirmed',
                'email' => 'required|email|unique:users',
                'level' => 'required|in:merchant,kantor',
                'nama_perusahaan' => 'nullable|string|max:255',
                'alamat' => 'nullable|string|max:255',
                'no_telp' => 'nullable|string|max:20',
                'deskripsi' => 'nullable|string',
            ]);

            // Buat pengguna baru
            $user = User::create([
                'username' => $validated['username'],
                'password' => Hash::make($validated['password']),
                'email' => $validated['email'],
                'level' => $validated['level'],
                'nama_perusahaan' => $request->input('nama_perusahaan', ''),
                'alamat' => $request->input('alamat', ''),
                'no_telp' => $request->input('no_telp', ''),
                'deskripsi' => $request->input('deskripsi', ''),
            ]);

            // Login otomatis
            Auth::login($user);

            // Tentukan URL redirect berdasarkan level pengguna
            $redirectUrl = $user->level == 'merchant' ? route('merchant') : route('kantor');

            return response()->json([
                'message' => 'User registered and logged in successfully',
                'redirect_url' => $redirectUrl
            ], 201);

        } catch (ValidationException $e) {
            // Handle validation exception
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->json([
                'message' => 'Registration failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            $user = Auth::user();
            $redirectUrl = $user->level == 'merchant' ? route('merchant') : route('kantor');

            Log::info('Redirect URL: ' . $redirectUrl); // Logging untuk debugging

            return response()->json([
                'message' => 'Login successful',
                'redirect_url' => $redirectUrl,
            ], 200);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
