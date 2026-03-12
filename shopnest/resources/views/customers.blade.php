<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers - VSN</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .customer-header {
            background: linear-gradient(135deg, #1a1a2e 0%, #0f3460 100%);
            color: white;
            padding: 2rem 0;
        }
        .customer-card {
            border-left: 4px solid #007bff;
            transition: all 0.3s ease;
        }
        .customer-card:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        .stats-badge {
            background: linear-gradient(45deg, #1a1a2e, #0f3460);
            color: white;
            border-radius: 20px;
            padding: 5px 15px;
            font-size: 0.85rem;
        }
        .customer-stats {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
        }
    </style>
</head>
<body style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 25%, #0f3460 50%, #16213e 75%, #1a1a2e 100%); min-height: 100vh;">
    <div class="customer-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="mb-0"><i class="fas fa-users me-3"></i>My Customers</h1>
                    <p class="mb-0 opacity-75">All customers who have ordered from your shop</p>
                </div>
                <div class="col-auto">
                    <a href="/dashboard/shopkeeper" class="btn btn-light">
                        <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-4">
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-users fa-2x text-primary mb-2"></i>
                        <h4>{{ $customers->count() }}</h4>
                        <small class="text-muted">Total Customers</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-shopping-cart fa-2x text-success mb-2"></i>
                        <h4>{{ $customers->sum('total_orders') }}</h4>
                        <small class="text-muted">Total Orders</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-rupee-sign fa-2x text-warning mb-2"></i>
                        <h4>₹{{ number_format($customers->sum('total_spent'), 0) }}</h4>
                        <small class="text-muted">Total Revenue</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-star fa-2x text-info mb-2"></i>
                        <h4>{{ number_format($customers->avg('total_spent'), 0) }}</h4>
                        <small class="text-muted">Avg Order Value</small>
                    </div>
                </div>
            </div>
        </div>

        @if($customers->count() > 0)
            <div class="row">
                @foreach($customers as $customer)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="customer-card card h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $customer['name'] }}</h6>
                                        <small class="text-muted">{{ $customer['email'] }}</small>
                                    </div>
                                </div>

                                <div class="customer-stats mb-3">
                                    <div class="row text-center">
                                        <div class="col-6">
                                            <strong class="text-primary">{{ $customer['total_orders'] }}</strong>
                                            <br><small>Orders</small>
                                        </div>
                                        <div class="col-6">
                                            <strong class="text-success">₹{{ number_format($customer['total_spent'], 0) }}</strong>
                                            <br><small>Spent</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="stats-badge">
                                            <i class="fas fa-clock me-1"></i>{{ $customer['status_counts']['pending'] }} Pending
                                        </span>
                                        <span class="stats-badge">
                                            <i class="fas fa-check me-1"></i>{{ $customer['status_counts']['delivered'] }} Done
                                        </span>
                                    </div>
                                </div>

                                @if($customer['last_order'])
                                    <div class="text-muted small">
                                        <i class="fas fa-calendar me-1"></i>
                                        Last order: {{ \Carbon\Carbon::parse($customer['last_order'])->diffForHumans() }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-users-slash fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No customers yet</h5>
                <p class="text-muted">You'll see your customers here once they start placing orders.</p>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
