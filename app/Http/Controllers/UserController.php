<?php

namespace App\Http\Controllers;

use App\Events\DeviceCreated;
use App\Events\UserRegistered;
use App\Events\ServiceRequested;
use App\Models\Device;
use App\Models\Invoice;
use App\Models\RepairRequest;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function register()
    {
        return view("users.auth.register");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required',
            'password' => 'required',
            'terms' => 'required'
        ]);

        $details = $request->except('_token', 'terms');
        $user = User::create($details);
        Auth::login($user);
        event(new UserRegistered($user));
        return redirect(route('user.dashboard'));
    }

    public function login()
    {
        return view('users.auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);

        $credentials = $request->only('email','password');
        if (Auth::attempt($credentials, $request->remember)) {
            return redirect()->intended(route('user.dashboard'));
        }
        else
        {
            return back()->withErrors(['email' => 'Incorrect credentials']);
        }
    }

    public function forgot()
    {
        return view('users.auth.forgot');
    }

    public function requestPasswordReset(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    public function passwordReset()
    {
        return view('users.auth.reset');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
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
                ? redirect()->route('user.login')->with('status', __($status))
                : back()->withErrors(['password' => [__($status)]]);
    }

    public function dashboard()
    {
        $devices = Device::where('user_id', auth()->id())->limit(2)->get();
        $requests = RepairRequest::whereHas('device', function ($query) {
            $query->where('user_id', auth()->id());
        })->get();
        $stats = [
            "devices" => $devices->count(),
            "paid" => Invoice::where('user_id', auth()->id())->where('status', 'paid')->count(),
            "unpaid" => Invoice::where('user_id', auth()->id())->where('status', 'unpaid')->count(),
            "pending" => $requests->where('status', 'pending')->count(),
            "completed" => $requests->where('status', 'completed')->count(),
            "spent" => Invoice::where('user_id', auth()->id())->where('status', 'paid')->sum('amount'),
            "total_invoice" => Invoice::where('user_id', auth()->id())->sum('amount'),
        ];

        return view('users.dashboard', ['stats' => $stats, 'devices' => $devices, 'requests' => $requests]);
    }

    public function devices()
    {
        $devices = Device::where('user_id', auth()->id())->get();
        return view('users.devices', ['devices'=> $devices]);
    }

    public function storeDevice(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'model' => 'required',
        ]);
        $details = $request->except('_token');
        $details['user_id'] = auth()->id();
        $device = Device::create($details);
        event(new DeviceCreated($device, auth()->user()));
        return back()->with('success','Device Added, an Invoice was generated please check your email');
    }

    public function invoices()
    {
        $invoices = Invoice::where('user_id', auth()->id())->get();
        return view('users.invoices', ['invoices'=> $invoices]);
    }

    public function showInvoice($invoice_id)
    {
        $invoice = Invoice::find($invoice_id);
        return view('users.invoice', ['invoice' => $invoice]);
    }

    public function requests()
    {
        $requests = RepairRequest::where('user_id', auth()->id())->get();
        $devices = Device::where(['user_id' => auth()->id(), 'status' => 'active'])->get();
        return view('users.requests', ['requests'=> $requests, 'devices' => $devices]);
    }

    public function storeRequest(Request $request)
    {
        $request->validate([
            'device_id' => 'required',
            'issue' => 'required',
        ]);

        $data = $request->only('device_id', 'issue');
        $data['user_id'] = auth()->id();

        $service = RepairRequest::create($data);
        event(new ServiceRequested($service));
        return back()->with('success', 'Your repair/service request has been submitted');
    }

    public function showRequest($request_id)
    {
        $service = RepairRequest::find($request_id);
        return view('users.request', ['service'=> $service]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('user.login'));
    }

    public function printInvoice($invoice_id)
    {
        $invoice = Invoice::find($invoice_id);
        $pdf = Pdf::loadView('users.prints.invoice', ["invoice" => $invoice]);
        return $pdf->stream('invoice.pdf');
    }
}
