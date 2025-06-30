@extends('layouts.app')

@push('custome-css')

@endpush

@section('content')

<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Employee</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Employee</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container">
        <div class="row">
            <h1 class="mt-3">Employee Sync Status</h1>

            <div class="card card-primary card-outline mb-4">
                <div class="card-header">
                    <div class="card-title">Employee Sync</div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                           
                            
                            @if ($data['status'] == true)
                                <span class="badge bg-success p-2">
                                    <i class="mdi mdi-check-circle-outline me-1"></i>
                                    Data Synced Successfully
                                </span>
                               
                            @else
                                <span class="badge bg-danger p-2">
                                    <i class="mdi mdi-close-circle-outline me-1"></i>
                                    Error Synced Successfully
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@push('custome-js')
@endpush
