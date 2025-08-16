<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LeaveTypeController extends Controller
{
    public function index()
    {
        $leaveTypes = LeaveType::paginate(20);
        return view('admin::leave_type.index', compact('leaveTypes'));
    }

    public function create()
    {
        return view('admin::leave_type.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'days' => 'required|integer|min:1',
            'status' => 'required|boolean',
        ]);
        LeaveType::create($request->all());
        return redirect()->route('admin.leaveType.index')->with('success', 'Leave type created successfully.');
    }

    public function edit(LeaveType $leave_type)
    {
        return view('admin::leave_type.edit', compact('leave_type'));
    }

    public function update(Request $request, LeaveType $leave_type)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'days' => 'required|integer|min:1',
            'status' => 'required|boolean',
        ]);
        $leave_type->update($request->all());
        return redirect()->route('admin.leaveType.index')->with('success', 'Leave type updated successfully.');
    }

    public function destroy(LeaveType $leave_type)
    {
        $leave_type->delete();
        return redirect()->route('admin.leaveType.index')->with('success', 'Leave type deleted successfully.');
    }
}
