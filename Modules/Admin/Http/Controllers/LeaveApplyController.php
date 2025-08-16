<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Models\LeaveApply;
use Modules\Admin\Models\Admin;
use App\Models\LeaveType;

class LeaveApplyController extends Controller
{
    public function index()
    {
        $leaveApplies = LeaveApply::with(['admin', 'leaveType', 'appliedBy', 'approvedBy'])->get();
        return view('admin::leaveapply.index', compact('leaveApplies'));
    }

    public function create()
    {
        $admins = Admin::all();
        $leaveTypes = LeaveType::all();
        return view('admin::leaveapply.create', compact('admins', 'leaveTypes'));
    }

    public function store(Request $request)
    {
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
        LeaveApply::create($validated);
        return redirect()->route('leave-apply.index')->with('success', 'Leave Apply created successfully.');
    }

    public function edit($id)
    {
        $leaveApply = LeaveApply::findOrFail($id);
        $admins = Admin::all();
        $leaveTypes = LeaveType::all();
        return view('admin::leaveapply.edit', compact('leaveApply', 'admins', 'leaveTypes'));
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
        return redirect()->route('leave-apply.index')->with('success', 'Leave Apply updated successfully.');
    }

    public function destroy($id)
    {
        $leaveApply = LeaveApply::findOrFail($id);
        $leaveApply->delete();
        return redirect()->route('leave-apply.index')->with('success', 'Leave Apply deleted successfully.');
    }

    public function changeStatus(Request $request, $id)
    {
        $leaveApply = LeaveApply::findOrFail($id);
        $leaveApply->status = $leaveApply->status == 1 ? 0 : 1;
        $leaveApply->approved_date = $leaveApply->status == 1 ? now() : null;
        $leaveApply->save();
        return response()->json(['status' => $leaveApply->status, 'approved_date' => $leaveApply->approved_date]);
    }
}
