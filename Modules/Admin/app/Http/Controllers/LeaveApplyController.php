<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use App\Models\Admin;
use App\Models\LeaveType;
use Illuminate\Support\Facades\Auth;
use Modules\Admin\Models\Employee;
use Modules\Admin\Models\LeaveApply;

class LeaveApplyController extends Controller
{
    public function index(Request $request)
    {
        $limit =  $request->limit ?? 15;
        $leaveApplies = LeaveApply::with(['employee', 'leaveType', 'appliedBy', 'approvedBy'])->paginate($limit);
        return view('admin::leaveapply.index', compact('leaveApplies'));
    }

    public function create()
    {
        $employees = Employee::where('status', 1)->get();
        $leaveTypes = LeaveType::where('status',1)->get();
        return view('admin::leaveapply.create', compact('employees', 'leaveTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'nullable|exists:employees,id',
            'leave_type_id' => 'required|exists:leave_types,id',
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'total_date' => 'required|integer|min:1',
            'note' => 'nullable|string',
            'status' => 'nullable|in:0,1',
            'apply_by' => 'nullable|exists:admins,id',
            'approved_by' => 'nullable|exists:admins,id',
            'approved_date' => 'nullable|date',
        ]);
        $validated['apply_by'] = Auth::guard('admin')->user()->id; // Set the applied_by to the current admin
        LeaveApply::create($validated);
        return redirect()->route('admin.leaveApply.index')->with('success', 'Leave Apply created successfully.');
    }

    public function edit($id)
    {
        $leaveApply = LeaveApply::findOrFail($id);
        $employees = Employee::where('status', 1)->get();
        $leaveTypes = LeaveType::where('status', 1)->get();
        return view('admin::leaveapply.edit', compact('leaveApply', 'employees', 'leaveTypes'));
    }

    public function update(Request $request, $id)
    {
        $leaveApply = LeaveApply::findOrFail($id);
        $validated = $request->validate([
            'admin_id' => 'nullable|exists:admins,id',
            'leave_type_id' => 'required|exists:leave_types,id',
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'total_date' => 'required|integer|min:1',
            'note' => 'nullable|string',
            'status' => 'nullable|in:0,1',
            'apply_by' => 'nullable|exists:admins,id',
            'approve_by' => 'nullable|exists:admins,id',
            'approved_date' => 'nullable|date',
        ]);
        $leaveApply->update($validated);
        return redirect()->route('admin.leaveApply.index')->with('success', 'Leave Apply updated successfully.');
    }

    public function destroy($id)
    {
        $leaveApply = LeaveApply::findOrFail($id);
        $leaveApply->delete();
        return redirect()->route('admin.leaveApply.index')->with('success', 'Leave Apply deleted successfully.');
    }

    public function changeStatus(Request $request, $id)
    {
        $leaveApply = LeaveApply::findOrFail($id);
        $leaveApply->status = $leaveApply->status == 1 ? 0 : 1;
        $leaveApply->approve_by = Auth::guard('admin')->user()->id;
        $leaveApply->approved_date = $leaveApply->status == 1 ? now() : null;
        $leaveApply->save();
        return response()->json([
            'status' => $leaveApply->status,
            'approved_date' => $leaveApply->approved_date ? $leaveApply->approved_date->format('Y-m-d') : null
        ]);
    }
}
