@extends('layouts.app')

@push('custome-css')
@endpush

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Leave Types</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Leave Types</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container">
        <div class="row">
            <h1 class="mt-3">Leave Type List</h1>

            <div class="d-flex justify-content-between align-items-end mt-3 mb-3">
                {{-- Search component (optional, same style as permission) --}}
                <form action="{{ url()->current() }}" method="GET" class="d-flex align-items-end gap-1">
                    @include('components.search')
                </form>

                {{-- Add button --}}
                <a href="{{ route('admin.leaveType.create') }}" class="btn btn-outline-primary">
                    <i class="mdi mdi-plus-circle mdi-12px"></i>
                </a>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Days</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($leaveTypes as $index => $leaveType)
                            <tr>
                                <td>{{ $leaveTypes->firstItem() + $index }}</td>
                                <td>{{ $leaveType->name }}</td>
                                <td>{{ $leaveType->days }}</td>
                                <td>
                                    @if($leaveType->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.leaveType.edit', $leaveType->id) }}"
                                       class="btn btn-sm btn-outline-info">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>

                                    <button type="button"
                                            class="btn btn-sm btn-outline-danger delete-btn"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"
                                            data-url="{{ route('admin.leaveType.destroy', $leaveType->id) }}">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No leave types found.</td>
                            </tr>
                        @endforelse

                        {{-- Reuse your global delete modal --}}
                        @include('components.delete')
                    </tbody>
                </table>

                <div class="d-flex mt-3">
                    {{ $leaveTypes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custome-js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Hook into delete modal (like in permission list)
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const url = this.getAttribute('data-url');
                const form = document.querySelector('#deleteModal form');
                form.action = url;
            });
        });
    });
</script>
@endpush
