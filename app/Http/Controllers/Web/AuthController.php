<?php

namespace App\Http\Controllers\Web;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use Illuminate\Cache\RateLimiter;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

use Illuminate\Foundation\Auth\EmailVerificationRequest;

use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Lockout;

use App\Models\User;

use App\Providers\RouteServiceProvider;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class AuthController extends Controller
{

    /**
     * The maximum number of attempts to allow.
     *
     * @var int
     */
    protected static $maxAttempts = 5;

    /**
     * The number of minutes to throttle for.
     *
     * @var int
     */
    protected static $decayMinutes = 1;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only([
            'verify_email',
            'send_verify_email',

            'confirm_password',

            'show_confirm_password_page',
            'show_verify_email_page',
        ]);

        $this->middleware('guest')->only([
            'login',
            'register',
            'reset_password',
            'forgot_password',

            'show_login_page',
            'show_register_page',
            'show_reset_password_page',
            'show_forgot_password_page',
        ]);

        $this->middleware('throttle:6,1')->only([
            'confirm_password',
            'send_verify_email',
        ]);

        $this->middleware('signed')->only('verify_email');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker();
    }

    /**
     * Get the rate limiter instance.
     *
     * @return RateLimiter
     */
    protected function limiter()
    {
        return app(RateLimiter::class);
    }

    /**
     * Get the throttle key for the given request.
     *
     * @param  Request  $request
     * @return string
     */
    protected function throttleKey(Request $request)
    {
        return Str::transliterate(Str::lower($request->input('username')) . '|' . $request->ip());
    }

    /**
     * Show login page
     *
     * @param  Request $request
     * @return Renderable
     */
    public function show_login_page(Request $request)
    {
        return view('site.auth.login');
    }

    /**
     * Show Register page
     *
     * @param  Request $request
     * @return Renderable
     */
    public function show_register_page(Request $request)
    {
        return view('site.auth.register');
    }

    /**
     * Show confirm password page
     *
     * @param  Request $request
     * @return Renderable
     */
    public function show_confirm_password_page(Request $request)
    {
        return view('site.auth.password.confirm');
    }

    /**
     * Show forgot password page
     *
     * @param  Request $request
     * @return Renderable
     */
    public function show_forgot_password_page(Request $request)
    {
        return view('site.auth.password.forgot');
    }

    /**
     * Show reset password page
     *
     * @param  Request $request
     * @param  string  $token
     * @return Renderable
     */
    public function show_reset_password_page(Request $request, string $token)
    {
        return view('site.auth.password.reset', ['token' => $token]);
    }

    /**
     * Show verify email page
     *
     * @param  Request $request
     * @return Renderable
     */
    public function show_verify_email_page(Request $request)
    {
        return view('site.auth.email.verify');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse|Response|JsonResponse
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $tooManyAttempts = $this->limiter()->tooManyAttempts(
            $this->throttleKey($request),
            static::$maxAttempts
        );

        if ($tooManyAttempts) {
            // Fire Lockout Event
            event(new Lockout($request));

            $seconds = $this->limiter()->availableIn(
                $this->throttleKey($request)
            );

            throw ValidationException::withMessages([
                'email' => [trans('auth.throttle', [
                    'seconds' => $seconds,
                    'minutes' => ceil($seconds / 60),
                ])],
            ])->status(Response::HTTP_TOO_MANY_REQUESTS);
        }

        $attemptLogin = $this->guard()->attempt(
            $request->only('email', 'password'),
            $request->boolean('remember')
        );

        if ($attemptLogin) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            $request->session()->regenerate();

            // Clear login attempts
            $this->limiter()->clear($this->throttleKey($request));

            // if ($response = $this->authenticated($request, $this->guard()->user())) {
            //     return $response;
            // }

            $this->authenticated($request, $this->guard()->user());

            // Send login response
            return $request->wantsJson()
                ? new JsonResponse([
                    'authenticated' => true,
                ], Response::HTTP_NO_CONTENT)
                : redirect()->intended(RouteServiceProvider::HOME);
        }

        // Increment login attempts
        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->limiter()->hit(
            $this->throttleKey($request),
            static::$decayMinutes * 60
        );

        // Send login failed response
        if (User::firstWhere(
            'email',
            $request->input('email')
        )) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        } else {
            throw ValidationException::withMessages([
                'email' => __('auth.email'),
            ]);
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse|JsonResponse
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse|JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->toArray(), [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'username' => ['required', 'string', 'min:4', 'max:20', 'unique:users,username'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'profile.first_name' => 'nullable|string|min:2|max:15',
            'profile.last_name' => 'nullable|string|min:2|max:15',
        ]);

        $validator->validate();

        // Create a user
        $user = User::create([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
        ]);

        event(new Registered($user));

        $this->guard()->login($user);

        $this->registered($request, $user);

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect(RouteServiceProvider::HOME);
    }

    /**
     * Confirm the given user's password.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse|JsonResponse
     */
    public function confirm_password(Request $request)
    {
        $request->validate([
            'password' => 'required|current_password:web',
        ], [
            'password' => __('auth.password'),
        ]);

        // $request->session()->put('auth.password_confirmed_at', time());
        $request->session()->passwordConfirmed();

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended(RouteServiceProvider::HOME);

        // Old style
        // if (!Hash::check($request->password, $request->user()->password)) {
        //     return back()->withErrors([
        //         'password' => ['The provided password does not match our records.']
        //     ]);
        // }

        // $request->session()->passwordConfirmed();

        // return redirect()->intended();
    }

    /**
     * Forgot password
     *
     * @param  Request $request
     * @return Response
     */
    public function forgot_password(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    /**
     * Reset password
     *
     * @param  Request $request
     * @return Response
     */
    public function reset_password(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    /**
     * Verify email
     *
     * @param  Request $request
     * @return Response
     */
    public function verify_email(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->route('home');
    }

    /**
     *
     *
     */
    public function send_verify_email(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }

    /**
     * The user has been authenticated.
     *
     * Actions to be done after user is authenticated
     *
     * @param  Request  $request
     * @param  mixed  $user
     * @return void
     */
    protected function authenticated(Request $request, $user)
    {
        //
    }

    /**
     * The user has been authenticated.
     *
     * Actions to be done after user is logged
     *
     * @param  Request  $request
     * @param  mixed  $user
     * @return void
     */
    protected function logged(Request $request, $user)
    {
        //
    }

    /**
     * The user has been registered.
     *
     * Actions to be done after user is registered
     *
     * @param  Request  $request
     * @param  mixed  $user
     * @return void
     */
    protected function registered(Request $request, $user)
    {
        $data = $request->except([
            'email',
            'username',
            'password',
        ]);

        if (isset($data['profile']) && is_array($data['profile']) && !empty($data['profile'])) {

            $metables = Arr::map($data['profile'], function ($value, $key) use($user) {
                return [
                    'name' => $key,
                    'value' => $value,
                    'group' => 'profile',
                    'metable_id' => $user->id,
                    'metable_type' => $user::class,
                ];
            });

            $user->metalist()->upsert(
                $metables,
                ['name', 'metable_id', 'metable_type'],
                ['value']
            );
        }

    }
}
