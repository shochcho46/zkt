<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\ZKTecoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class SettingController extends Controller
{

    protected function getZKServiceFromUser()
    {
        $user = Auth::guard('admin')->user();

        $settingDetails = Setting::where('admin_id', $user->id)->first();

        // Example: assuming user has zkteco_ip and zkteco_port columns
        $ip = $settingDetails->matchine_ip;
        $port = $settingDetails->matchine_port ?? 4370;

        return new ZKTecoService($ip, $port);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::guard('admin')->user();
        $setting = Setting::where('admin_id', $user->id)->first();
        if ($setting) {
            return view('admin::setting.edit', compact('setting'));
        }
        return view('admin::setting.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'logo_name' => 'required|string|max:255',
            'matchine_ip' => 'required',
            'matchine_port' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'delay_time' => 'required',
        ]);
        // Convert delay_time from seconds to minutes before saving
        $validatedData['delay_time'] = $validatedData['delay_time'] ?? 0;


        $validatedData['admin_id'] = Auth::guard('admin')->user()->id;
        Setting::create($validatedData);

        $toaster = [
            'message' => 'Setting created successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.settingCreate')->with($toaster);
    }

    /**
     * Display the specified resource.
     */
    public function connection(Setting $setting)
    {
        $zkService = $this->getZKServiceFromUser();

        $connection['status'] = $zkService->connect();

        if ($connection['status'] == true) {
            $deviceName = $zkService->deviceName();
            if ($deviceName['status'] == false) {
                $connection['status'] = false;
                return view('admin::setting.connection', compact('connection'));
            }

            $raw = $deviceName['data'] ?? '';
            preg_match('/~DeviceName=([^\/]+)/', $raw, $matches);
            $deviceName = $matches[1] ?? 'Unknown';

            $connection['name'] = $deviceName;
            $time = $zkService->getTime();
            if ($time['status'] == false) {
                $connection['status'] = false;

                $view = view('admin::setting.connection', ['connection' => $connection])->render();
                // return view('admin::setting.connection', compact('connection'));

                return response()->json([
                            'view' => $view
                        ]);
            }

            $connection['time'] = $time['data'] ?? '';


            $view = view('admin::setting.connection', ['connection' => $connection])->render();
            return response()->json([
                'view' => $view
            ]);
            // return view('admin::setting.connection', compact('connection'));
        } else {
            $connection['status'] = false;

            $view = view('admin::setting.connection', ['connection' => $connection])->render();
            // return view('admin::setting.connection', compact('connection'));
            return response()->json([
                'view' => $view
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $validatedData = $request->validate([
            'logo_name' => 'required|string|max:255',
            'matchine_ip' => 'required',
            'matchine_port' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'delay_time' => 'required',
        ]);

        $validatedData['delay_time'] = $validatedData['delay_time'] ?? 0;
        $setting->update($validatedData);

        $toaster = [
            'message' => 'Setting updated successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.settingCreate')->with($toaster);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
