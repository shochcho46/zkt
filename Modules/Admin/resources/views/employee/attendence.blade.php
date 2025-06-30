@extends('layouts.app')

@push('custome-css')

@endpush

@section('content')

<div class="app-content-header"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Employee Attendence</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ route('admin.indexAttendence') }}">Attendence</a>
                    </li>
                </ol>
            </div>
        </div> <!--end::Row-->
    </div> <!--end::Container-->
</div>

    <div class="app-content">
        <div class="container">
            <div class="row">
                <h1 class="mt-3">{{ $employee->name }} Attendence List</h1>
                <div class="d-flex justify-content-between align-items-end mt-3 mb-3">


                    <form action="{{ url()->current() }}" method="GET" class="d-flex align-items-end gap-1">
                        @include('components.daterange')
                            <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                        @include('components.search')
                    </form>

                    <div class="d-flex gap-1">
                        <a href="{{ route('admin.attendence') }}" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Sync all data">
                            <i class="mdi mdi-sync-circle mdi-24px"></i>
                        </a>

                        <a href="{{ route('admin.exportAttendence',request()->query()) }}" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Export all data">
                            <i class="mdi mdi-microsoft-excel mdi-24px"></i>
                        </a>
                    </div>
                </div>


                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Time</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($datas as $index => $item)
                            <tr>
                                <th scope="row">{{ $datas->firstItem() + $index }}</th>
                                <td>{{ $item?->employee?->name }}</td>
                                <td>{{ $item?->timestamp }}</td>

                                <td class="text-center">
                                    <a href="{{ route('admin.permissionEdit', $item->id) }}" class="btn btn-sm btn-outline-info"> <i class="mdi mdi-pencil "></i></a>

                                    <button type="button" class="btn btn-sm btn-outline-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-url="{{ route('admin.permissionDestroy', $item->id) }}">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No items found.</td>
                            </tr>
                        @endforelse
                        @include('components.delete')
                        </tbody>
                    </table>

                    <div class="d-flex mt-3">
                        {{ $datas->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection



@push('custome-js')

@endpush
