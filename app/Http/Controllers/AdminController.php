<?php

namespace App\Http\Controllers;

use App\Events\DeviceCreated;
use App\Events\InvoiceCreated;
use App\Events\ServiceUpdated;
use App\Events\UserCreatedAdmin;
use App\Models\Admin;
use App\Models\Configuration;
use App\Models\Device;
use App\Models\Invoice;
use App\Models\RepairRequest;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login()
    {
        return view('users.auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );

        if (Auth::guard('admin')->attempt($request->only('email', 'password'), $request->remember))
        {
            return redirect()->intended(route('admin.dashboard'));
        }
    }

    public function dashboard()
    {
        $stats = [
            'users' => User::count(),
            'admins' => Admin::count(),
            'devices' => Device::count(),
            'active_devices' => Device::where('status', 'active')->count(),
            'inactive_devices' => Device::where('status', 'inactive')->count(),
            'total_paid' => Invoice::where('status', 'paid')->sum('amount'),
            'total_unpaid' => Invoice::where('status', 'unpaid')->sum('amount'),
            'pending_requests' => RepairRequest::where('status', 'pending')->count(),
            'attending_requests' => RepairRequest::where('status', 'attending')->count(),
            'completed_requests' => RepairRequest::where('status', 'completed')->count(),
        ];
        return view('admin.dashboard', ['stats' => $stats]);
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', ['users' => $users]);
    }

    public function getUser($user_id)
    {
        $user = User::find($user_id);
        return view('admin.user', ['user'=> $user]);
    }

    public function deleteUser($user_id)
    {
        Device::where('user_id', $user_id)->delete();
        RepairRequest::where('user_id', $user_id)->delete();
        Invoice::where('user_id', $user_id)->delete();
        User::destroy($user_id);
        return back()->with('success','user deleted');
    }

    public function userForm()
    {
        return view('admin.add_user');
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required',
        ]);

        $data = $request->except('_token');
        $data['password'] = $request->phone_number;
        $user = User::create($data);
        event(new UserCreatedAdmin($user));
        return back()->with('success', "User created, account details has been mailed to {$user->email}");
    }

    public function updateUser($user_id, Request $request)
    {
        $request->validate([
            "name" => "required",
            "phone_number" => "required",
        ]);

        $data = $request->except("_token", "email");
        User::where("id", $user_id)->update($data);
        return back()->with('success', "user info updated");
    }

    public function admins()
    {
        $admins = Admin::all();
        return view('admin.admins', ['admins' => $admins]);
    }

    public function addAdmin()
    {
        $roles = ['super_admin', 'manager', 'receptionist'];
        return view('admin.add_admin', ['roles'=> $roles]);
    }

    public function createAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'password' => 'required'
        ]);

        $data = $request->except('_token');
        $admin = Admin::create($data);
        return back()->with('success','Admin created');
    }

    public function getAdmin($admin_id)
    {
        $admin = Admin::find($admin_id);
        $roles = ['super_admin', 'manager', 'receptionist'];
        return view('admin.admin', ['admin'=> $admin, 'roles' => $roles]);
    }

    public function updateAdmin($admin_id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);

        $data = $request->except('_token');
        Admin::where('id', $admin_id)->update($data);
        return back()->with('success','admin info updated');
    }

    public function deleteAdmin($admin_id)
    {
        Admin::where('id', $admin_id)->delete();
        return back()->with('success','admin deleted');
    }

    public function requests()
    {
        $pending_requests = RepairRequest::where('status', 'pending')->latest()->get();
        $attending_requests = RepairRequest::where('status', 'attending')->latest()->get();
        $completed_requests = RepairRequest::where('status', 'completed')->get();

        return view('admin.requests', ['pending_requests'=> $pending_requests, 'attending_requests'=> $attending_requests, 'completed_requests'=> $completed_requests]);
    }

    public function getRequest($id)
    {
        $request = RepairRequest::find($id);
        return view('admin.request', ['service'=> $request]);
    }

    public function updateRequestStatus(Request $request)
    {
        $request->validate(['status' => 'required']);
        $id = $request->request_id;
        RepairRequest::where('id', $id)->update(['status' => $request->status]);
        $service = RepairRequest::find($id);
        event(new ServiceUpdated($service));
        return back()->with('success','service status updated');
    }

    public function generateServiceInvoice(Request $request)
    {
        $request->validate(['amount' => 'required']);
        $id = $request->request_id;
        $service = RepairRequest::find($id);

        $invoice = Invoice::create([
            'user_id' => $service->user->id,
            'item_id' => $service->id,
            'item_type' => 'repair',
            'invoice_number' => date('ismyhd'),
            'description' => 'Service Charge',
            'amount' => $request->amount,
            'status' => 'unpaid'
        ]);

        event(new InvoiceCreated($invoice, $service->user));
        return back()->with('success','Invoice generated and sent to user');
    }

    public function devices()
    {
        $devices = Device::all();
        return view('admin.devices', ['devices'=> $devices]);
    }

    public function addDevice()
    {
        $users = User::all();
        return view('admin.add_device', ['users'=> $users]);
    }

    public function createDevice(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'user_id' => 'required'
        ]);

        $user = User::find($request->user_id);
        $data = $request->except('_token');
        $data['status'] = 'active';
        $device = Device::create($data);
        event(new DeviceCreated($device, $user, true));
        return redirect(route('admin.devices'))->with('success','Device created');
    }

    public function getDevice($id)
    {
        $device = Device::find($id);
        $users = User::all();
        return view('admin.device', ['device'=> $device, 'users' => $users]);
    }

    public function updateDevice($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'user_id' => 'required'
        ]);

        $data = $request->except('_token');
        Device::where('id', $id)->update($data);
        return back()->with('success','Device updated');
    }

    public function deleteDevice($id)
    {
        Invoice::where('item_type', 'device')->where('item_id', $id)->delete();
        RepairRequest::where('device_id', $id)->delete();
        Device::destroy($id);
        return back()->with('success', 'Device deleted');
    }

    public function settings()
    {
        $configurations = Configuration::all();
        return view('admin.settings', ['configurations'=> $configurations]);
    }

    public function saveSettings(Request $request)
    {
        $names = $request->names;
        $values = $request->values;

        if (!is_array($names) || !is_array($values))
        {
            return back()->withErrors(['error' => 'an error occured please try again']);
        }

        for ($i = 0; $i < count($names); $i++)
        {
            $name = $names[$i];
            $value = $values[$i];
            Configuration::where('name', $name)->update(['value'=> $value]);
        }

        return back()->with('success','Settings saved');
    }

    public function printDeviceInvoice($device_id)
    {
        $invoice = Invoice::where('item_id', $device_id)->where('item_type', 'device')->first();
        $pdf = Pdf::loadView('users.prints.invoice', ["invoice" => $invoice]);
        return $pdf->stream('invoice.pdf');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
