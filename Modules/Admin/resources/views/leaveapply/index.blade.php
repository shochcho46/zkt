@extends('layouts.app')

@push('custome-css')
@endpush

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Leave Applies</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Leave Applies</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <h1 class="mt-3">Leave Apply List</h1>

            <div class="d-flex justify-content-between align-items-end mt-3 mb-3">
                {{-- Search component (optional) --}}
                <form action="{{ url()->current() }}" method="GET" class="d-flex align-items-end gap-1">
                    @include('components.search')
                </form>

                {{-- Add button --}}
                <a href="{{ route('admin.leaveApply.create') }}" class="btn btn-outline-primary">
                    <i class="mdi mdi-plus-circle mdi-12px"></i>
                </a>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Admin</th>
                            <th>Leave Type</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Total Days</th>
                            <th>Status</th>
                            <th>Applied By</th>
                            <th>Approved By</th>
                            <th>Approved Date</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($leaveApplies as $index => $leave)
                            <tr id="row-{{ $leave->id }}">
                                <td>{{ $leaveApplies->firstItem() + $index }}</td>
                                <td>{{ $leave->employee->name ?? '-' }}</td>
                                <td>{{ $leave->leaveType->name ?? '-' }}</td>
                                <td>{{ $leave->from_date }}</td>
                                <td>{{ $leave->to_date }}</td>
                                <td>{{ $leave->total_date }}</td>
                                <td>
                                    <div class="form-check form-switch d-inline-block">
                                        <input class="form-check-input change-status"
                                               type="checkbox"
                                               role="switch"
                                               id="status-switch-{{ $leave->id }}"
                                               data-id="{{ $leave->id }}"
                                               {{ $leave->status ? 'checked' : '' }}>
                                        <label class="ms-2" for="status-switch-{{ $leave->id }}">
                                            <span id="status-{{ $leave->id }}" class="badge {{ $leave->status ? 'bg-success' : 'bg-warning' }}">
                                                {{ $leave->status ? 'Approved' : 'Pending' }}
                                            </span>
                                        </label>
                                    </div>
                                </td>
                                <td>{{ $leave->appliedBy->name ?? '-' }}</td>
                                <td>{{ $leave->approvedBy->name ?? '-' }}</td>
                                <td id="approved-date-{{ $leave->id }}">
                                    {{ $leave->approved_date ? \Illuminate\Support\Carbon::parse($leave->approved_date)->format('Y-m-d') : '-' }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.leaveApply.edit', $leave->id) }}"
                                       class="btn btn-sm btn-outline-info">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>

                                    <button type="button"
                                            class="btn btn-sm btn-outline-danger delete-btn"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"
                                            data-url="{{ route('admin.leaveApply.destroy', $leave->id) }}">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">No leave applies found.</td>
                            </tr>
                        @endforelse

                        {{-- Reuse global delete modal --}}
                        @include('components.delete')
                    </tbody>
                </table>

                <div class="d-flex mt-3">
                    {{ $leaveApplies->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custome-js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Delete modal
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const url = this.getAttribute('data-url');
                const form = document.querySelector('#deleteModal form');
                form.action = url;
            });
        });

        // AJAX toggle status
        document.querySelectorAll('.change-status').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                fetch(`{{ url('admin/leave-apply') }}/${id}/change-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({})
                })
                .then(response => response.json())
                .then(res => {
                    const statusBadge = document.querySelector(`#status-${id}`);
                    statusBadge.textContent = res.status ? 'Approved' : 'Pending';
                    statusBadge.classList.remove('bg-success', 'bg-warning');
                    statusBadge.classList.add(res.status ? 'bg-success' : 'bg-warning');

                    document.querySelector(`#approved-date-${id}`).textContent = res.approved_date ?? '-';
                });
            });
        });
    });
</script>
@endpush
