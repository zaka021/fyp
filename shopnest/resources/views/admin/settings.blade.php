@extends('admin.layout')

@section('title', 'Settings')
@section('page-title', 'System Settings')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-8 mb-4">
            <div class="stats-card">
                <h5 class="mb-4">System Information</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="border rounded p-3">
                            <h6 class="text-muted mb-2">Platform Version</h6>
                            <h5>ShopNest v1.0</h5>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="border rounded p-3">
                            <h6 class="text-muted mb-2">Laravel Version</h6>
                            <h5>{{ app()->version() }}</h5>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="border rounded p-3">
                            <h6 class="text-muted mb-2">PHP Version</h6>
                            <h5>{{ PHP_VERSION }}</h5>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="border rounded p-3">
                            <h6 class="text-muted mb-2">Database</h6>
                            <h5>{{ config('database.default') }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 mb-4">
            <div class="stats-card">
                <h5 class="mb-4">Admin Profile</h5>
                <div class="text-center mb-4">
                    <div class="bg-primary rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="fas fa-user-shield fa-2x text-white"></i>
                    </div>
                    <h6>{{ Auth::user()->name }}</h6>
                    <small class="text-muted">{{ Auth::user()->email }}</small>
                </div>
                <div class="border-top pt-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Role:</span>
                        <span class="badge bg-danger">Admin</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Last Login:</span>
                        <span>{{ now()->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="stats-card">
                <h5 class="mb-4">Platform Settings</h5>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <h6>General Settings</h6>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">User Registration</h6>
                                    <small class="text-muted">Allow new users to register</small>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" checked>
                                </div>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Email Verification</h6>
                                    <small class="text-muted">Require email verification for new users</small>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox">
                                </div>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Maintenance Mode</h6>
                                    <small class="text-muted">Put the site in maintenance mode</small>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <h6>Order Settings</h6>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Auto Accept Orders</h6>
                                    <small class="text-muted">Automatically accept new orders</small>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox">
                                </div>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Order Notifications</h6>
                                    <small class="text-muted">Send notifications for new orders</small>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" checked>
                                </div>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Stock Alerts</h6>
                                    <small class="text-muted">Alert when products are low in stock</small>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" checked>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-top pt-4 mt-4">
                    <button class="btn btn-primary me-2">Save Settings</button>
                    <button class="btn btn-outline-secondary">Reset to Default</button>
                </div>
            </div>
        </div>
    </div>

    <!-- System Actions -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="stats-card">
                <h5 class="mb-4">System Actions</h5>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <button class="btn btn-outline-primary w-100 py-3">
                            <i class="fas fa-database fa-2x mb-2 d-block"></i>
                            Backup Database
                        </button>
                    </div>
                    <div class="col-md-3 mb-3">
                        <button class="btn btn-outline-success w-100 py-3">
                            <i class="fas fa-sync fa-2x mb-2 d-block"></i>
                            Clear Cache
                        </button>
                    </div>
                    <div class="col-md-3 mb-3">
                        <button class="btn btn-outline-info w-100 py-3">
                            <i class="fas fa-download fa-2x mb-2 d-block"></i>
                            Export Data
                        </button>
                    </div>
                    <div class="col-md-3 mb-3">
                        <button class="btn btn-outline-warning w-100 py-3">
                            <i class="fas fa-tools fa-2x mb-2 d-block"></i>
                            System Check
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
