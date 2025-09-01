<?php

namespace Modules\Admin\Http\Controllers;

use App\Exports\AttendanceExport;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\ZKTecoService;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Admin\Models\Attendence;
use Modules\Admin\Models\Employee;

class EmployeeController extends Controller
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
    public function indexAttendence(Request $request)
    {
        $perPage = $request->input('limit', 500);
        $datas = Attendence::query();
        $datas = $datas->orderBy('id', 'desc')->with('employee')

            ->when($request->filled('from_date') && $request->filled('to_date'), function ($query) use ($request) {
                $startDate = Carbon::parse($request->input('from_date'))->startOfDay();
                $endDate = Carbon::parse($request->input('to_date'))->endOfDay();
                $query->whereBetween('timestamp', [$startDate, $endDate]);
            })
            ->paginate($perPage);
        return view('admin::employee.attendenceIndex', compact('datas'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function exportAttendence(Request $request)
    {
        $filename = 'attendance.xlsx';

        if ($request->filled('employee_id')) {
            $employeeName = Employee::find($request->input('employee_id'))->name ?? 'all';
            $startDate = $request->filled('from_date') ? Carbon::parse($request->input('from_date')) : Carbon::now();
            $endDate = $request->filled('to_date') ? Carbon::parse($request->input('to_date')) : Carbon::now();
            $filename = "{$employeeName} attendance - {$startDate->format('Y-M')}.xlsx";
        }
            # code...
            return Excel::download(new AttendanceExport($request),$filename);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function indexEmployee(Request $request)
    {
        $perPage = $request->input('limit', 500);
        $datas = Employee::query();
        $datas = $datas->orderBy('id', 'desc')
            ->when($request->filled('name'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->input('name') . '%');
            })
            ->paginate($perPage);
        return view('admin::employee.employeelist', compact('datas'));
    }

    /**
     * Show the specified resource.
     */
    public function singelEmployeeAttendence(Request $request, Employee $employee)
    {
        $perPage = $request->input('limit', 500);
        $datas = Attendence::query();
        $datas = $datas->orderBy('id', 'desc')
            ->where('employee_id', $employee->id)
            ->with('employee')
            ->when($request->filled('from_date') && $request->filled('to_date'), function ($query) use ($request) {
                $startDate = Carbon::parse($request->input('from_date'))->startOfDay();
                $endDate = Carbon::parse($request->input('to_date'))->endOfDay();
                $query->whereBetween('timestamp', [$startDate, $endDate]);
            })
            ->paginate($perPage);
        return view('admin::employee.attendence', compact('datas','employee'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get the next userid by finding the last employee's userid and incrementing
        $lastEmployee = Employee::orderBy('userid', 'desc')->first();
        $nextUserId = $lastEmployee ? $lastEmployee->userid + 1 : 1;
        $nextUid = Employee::orderBy('uid', 'desc')->first();
        $nextUid = $nextUid ? $nextUid->uid + 1 : 1;

        return view('admin::employee.create', compact('nextUserId','nextUid'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'userid' => 'required|unique:employees,userid',
            'uid' => 'required|unique:employees,uid',
            'role' => 'required|integer',
            'cardno' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        // Get current admin id
        $validated['admin_id'] = Auth::guard('admin')->user()->id;

        $employeeDetail = Employee::create($validated);

        $zkService = $this->getZKServiceFromUser();
        $attendenceData = $zkService->createUser($employeeDetail);

        return redirect()->route('admin.indexEmployee')->with('success', 'Employee created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('admin::employee.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateEmployee(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cardno' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $employee->update($validated);


        $zkService = $this->getZKServiceFromUser();
        $attendenceData = $zkService->createUser($employee->fresh());

        return redirect()->route('admin.indexEmployee')->with('success', 'Employee updated successfully.');
    }

    /**
     * Sync attendance data from ZK device.
     */
    public function update(Request $request, $id)
    {
        $attendenceData = $attendenceData[1] ?? [];

        // Process attendance data in chunks of 500
        foreach (array_chunk($attendenceData, 500) as $chunk) {
            foreach ($chunk as $item) {
                $insertData = [
                    'uid'         => $item['uid'],
                    'userid'      => $item['id'],
                    'state'       => $item['state'],
                    'timestamp'   => $item['timestamp'],
                    'type'        => $item['type'],
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ];

                // Fetch employee (avoid doing this in loop if possible — see below)
                $existingEmployee = Employee::where('userid', $item['id'])->first();
                $insertData['employee_id'] = $existingEmployee->id ?? null;

                // Avoid duplicate entries
                $exists = Attendence::where('uid', $item['uid'])->exists();

                if (!$exists) {
                    Attendence::create($insertData);
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function syncAttendence()
    {
        $zkService = $this->getZKServiceFromUser();
        $attendenceData = $zkService->getAttendance();
        if ($attendenceData['status'] == false) {
            $data['status'] = false;
            return view('admin::employee.sync', compact('data'));
        }
        $attendenceData = array_values($attendenceData);

        $attendenceData = array_values($attendenceData[1]);

        foreach ($attendenceData as $key => $item) {

            $insertData['uid'] = $item['uid'];
            $insertData['userid'] = $item['id'];
            $insertData['state'] = $item['state'];
            $insertData['timestamp'] = $item['timestamp'];
            $insertData['type'] = $item['type'];


              $existingData = Attendence::where('uid', $item['uid'])->first();
              $existingEmployee = Employee::where('userid', $item['id'])->first();
              $insertData['employee_id'] = $existingEmployee->id ?? null;

              if ($existingData) {
                  // Update existing employee
                //   $existingData->update($insertData);
              } else {
                  // Insert new employee
                  Attendence::create($insertData);
              }
          }

          $data['status'] = true;
          return view('admin::employee.attendenceSync', compact('data'));

    }

    public function syncUser()
    {
        $zkService = $this->getZKServiceFromUser();
        $values = $zkService->syncUser();

        if ($values['status'] == false) {
            $data['status'] = false;
            return view('admin::employee.sync', compact('data'));
        }
        $userList = array_values($values);
        $userList = array_values($userList[1]);

        foreach ($userList as $key => $item) {
          $insertData['uid'] = $item['uid'];
          $insertData['role'] = $item['role'];
          $insertData['name'] = $item['name'];
          $insertData['userid'] = $item['userid'];
          $insertData['cardno'] = $item['cardno'];


            $existingEmployee = Employee::where('uid', $item['uid'])->first();
            if ($existingEmployee) {
                // Update existing employee
                $existingEmployee->update($insertData);
            } else {
                // Insert new employee
                Employee::create($insertData);
            }
        }

        $data['status'] = true;
        return view('admin::employee.sync', compact('data'));


    }

    public function destroy(Employee $employee)
    {
        $zkService = $this->getZKServiceFromUser();
        $attendenceData = $zkService->removeUser($employee);
        $employee->delete();

        return redirect()->route('admin.indexEmployee')->with('success', 'Employee deleted successfully.');
    }
}
