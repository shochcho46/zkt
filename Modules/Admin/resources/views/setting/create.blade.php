@extends('layouts.app')

@push('custome-css')
@endpush

@section('content')

<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Settings</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Settings
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container">
        <div class="row">
            <h1 class="mt-3">Settings Form</h1>

            <div class="card card-primary card-outline mb-4">
                <div class="card-header">
                    <div class="card-title">Update Settings</div>
                </div>

                <form action="{{ route('admin.settingStore') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="logo_name" class="form-label">Logo Name</label>
                                <input type="text" class="form-control" id="logo_name" name="logo_name" placeholder="Logo Name">
                                @error('logo_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                    
                            <div class="col-md-4 mb-3">
                                <label for="matchine_ip" class="form-label">Machine IP</label>
                                <input type="text" class="form-control" id="matchine_ip" name="matchine_ip" placeholder="e.g., 192.168.0.100">
                                @error('matchine_ip')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                    
                            <div class="col-md-4 mb-3">
                                <label for="matchine_port" class="form-label">Machine Port</label>
                                <input type="text" class="form-control" id="matchine_port" name="matchine_port" placeholder="e.g., 4370">
                                @error('matchine_port')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="start_time" class="form-label">Start Time</label>
                                <input type="time" class="form-control" id="start_time" name="start_time">
                                @error('start_time')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                    
                            <div class="col-md-4 mb-3">
                                <label for="end_time" class="form-label">End Time</label>
                                <input type="time" class="form-control" id="end_time" name="end_time">
                                @error('end_time')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                    
                            <div class="col-md-4 mb-3">
                                <label for="delay_time" class="form-label">Delay Time (minutes)</label>
                                <input type="number" class="form-control" id="delay_time" name="delay_time" placeholder="e.g., 15">
                                @error('delay_time')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save Settings</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('custome-js')
@endpush
