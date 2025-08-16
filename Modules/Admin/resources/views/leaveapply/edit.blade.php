@extends('layouts.app')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Edit Leave Apply</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.leaveApply.index') }}">Leave Applies</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Leave Apply Details</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.leaveApply.update', $leaveApply->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="employee_id" class="form-label">Employee <span class="text-danger">*</span></label>
                            <select name="employee_id" id="employee_id" class="form-control @error('employee_id') is-invalid @enderror" required>
                                <option value="">Select Employee</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}" {{ old('employee_id', $leaveApply->employee_id) == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('employee_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="leave_type_id" class="form-label">Leave Type <span class="text-danger">*</span></label>
                            <select name="leave_type_id" id="leave_type_id" class="form-control @error('leave_type_id') is-invalid @enderror" required>
                                <option value="">Select Leave Type</option>
                                @foreach($leaveTypes as $type)
                                    <option value="{{ $type->id }}" {{ old('leave_type_id', $leaveApply->leave_type_id) == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('leave_type_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="0" {{ old('status', $leaveApply->status) == 0 ? 'selected' : '' }}>Pending</option>
                                <option value="1" {{ old('status', $leaveApply->status) == 1 ? 'selected' : '' }}>Approved</option>
                            </select>
                            @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="from_date" class="form-label">From Date <span class="text-danger">*</span></label>
                            <input type="date" id="from_date" name="from_date"
                                   class="form-control @error('from_date') is-invalid @enderror"
                                   value="{{ old('from_date', $leaveApply->from_date) }}" required>
                            @error('from_date') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="to_date" class="form-label">To Date <span class="text-danger">*</span></label>
                            <input type="date" id="to_date" name="to_date"
                                   class="form-control @error('to_date') is-invalid @enderror"
                                   value="{{ old('to_date', $leaveApply->to_date) }}" required>
                            @error('to_date') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="total_date" class="form-label">Total Days <span class="text-danger">*</span></label>
                            <input type="number" id="total_date" name="total_date"
                                   class="form-control @error('total_date') is-invalid @enderror"
                                   value="{{ old('total_date', $leaveApply->total_date) }}" required min="1">
                            @error('total_date') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="note" class="form-label">Note</label>
                            <textarea id="note" name="note" class="form-control @error('note') is-invalid @enderror">{{ old('note', $leaveApply->note) }}</textarea>
                            @error('note') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="mdi mdi-content-save"></i> Update
                        </button>
                        <a href="{{ route('admin.leaveApply.index') }}" class="btn btn-secondary">
                            <i class="mdi mdi-arrow-left"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custome-js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fromDate = document.getElementById('from_date');
        const toDate = document.getElementById('to_date');
        const totalDate = document.getElementById('total_date');

        function calculateDays() {
            if (fromDate.value && toDate.value) {
                const start = new Date(fromDate.value);
                const end = new Date(toDate.value);
                const diff = Math.floor((end - start) / (1000*60*60*24)) + 1;
                if (diff > 0) {
                    totalDate.value = diff;
                }
            }
        }

        fromDate.addEventListener('change', calculateDays);
        toDate.addEventListener('change', calculateDays);
    });
</script>
@endpush
