<?php

namespace Modules\UserInteractions\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Modules\UserInteractions\Models\User;
use Modules\UserInteractions\Repositories\UserRepository;

use Modules\UserInteraction\Request\UserRequest;

class UserController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function loginView()
    {
        if (Auth::check()) {
            return redirect(route('company.index'));
        }
        return view("UserInteractions::auth.login");
    }

    public function loginPost(Request $request)
    {

        // Attempt to authenticate with the given email, password, and active status.
        $rememberMe = $request->has('remember_me');

        try {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password
            ];

            if (Auth::attempt($credentials, $rememberMe)) {
                // If authentication is successful, redirect to the company index.
                // dd(Auth::user());
                return redirect()->route('company.index');
            } else {
                // If authentication fails, return to the login page with an error message.
                return redirect()->route('login')
                    ->withErrors(['error' => 'Invalid Login Details'])
                    ->withInput();
            }
        } catch (\Exception $e) {
            // Log any exceptions for debugging purposes.
            Log::error("Login error: " . $e->getMessage());

            // Return to the login page with a generic error message.
            return redirect()->route('login')
                ->withErrors(['error' => 'An unexpected error occurred. Please try again.'])
                ->withInput();
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }
    public function showLinkRequestForm()
    {
        return view('UserInteractions::auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return redirect()->route('login')->with(['status' => __($status)]);
        }

        return back()->withErrors(['email' => __($status)]);
    }
    public function showResetForm(Request $request, $token)
    {
        return view('UserInteractions::auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    public function reset(Request $request)
    {

        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', __($status));
        }

        return back()->withErrors(['email' => [__($status)]]);
    }

    public function edit()
    {
        return view('UserInteractions::auth.profile');
    }
    
    public function update(Request $request, User $user)
    {
        $request->validate([
            'photo' => 'required|image|max:21048',
        ]);

        // Remove the existing profile photo
        if ($user->photo_path) {
            $oldPhotoPath = storage_path('app/public/users/' . $user->photo_path);
            if (file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath);
            }
        }

        // Store the new profile photo
        $photoPath = $request->file('photo')->store('users', 'public');

        // Update the user's photo_path in the database
        $user->photo_path = $photoPath;
        $user->save();

        return redirect()->back()->with('success', 'Profile photo updated successfully');
    }

    public function changePassword(Request $request)
    {
        try {
            // Validate the incoming request data with enhanced rules
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8|different:current_password',
                'confirm_new_password' => 'required|same:new_password',
            ]);

            // Get the authenticated user
            $user = Auth::user();

            // Check if the current password is correct
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()
                    ->with('error', 'Current password is incorrect.')
                    ->withInput();
            }
            
            // Update the user's password
         
            $user->password = Hash::make($request->new_password);
            $user->save();

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Password changed successfully.');
        } catch (ValidationException $ve) {
            // If validation fails, return to the previous page with error messages
            return redirect()->back()
                ->withErrors($ve->errors())
                ->withInput();
        } catch (\Exception $e) {
            // Log any unexpected errors
            Log::error("Error changing password: " . $e->getMessage());

            // Return with a generic error message
            return redirect()->back()
                ->with('error', 'An unexpected error occurred. Please try again.')
                ->withInput();
        }
    }
}
