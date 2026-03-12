<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - VSN</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .notification-card {
            border-left: 4px solid #007bff;
            transition: all 0.3s ease;
        }
        .notification-card:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .status-pending { border-left-color: #ffc107; }
        .status-accepted { border-left-color: #28a745; }
        .status-cancelled { border-left-color: #dc3545; }
        .status-flagged { border-left-color: #fd7e14; }
        .notification-header {
            background: linear-gradient(135deg, #1a1a2e 0%, #0f3460 100%);
            color: white;
            padding: 2rem 0;
        }
        .btn-action {
            margin: 2px;
            min-width: 80px;
        }
        .order-details {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin: 10px 0;
        }
    </style>
</head>
<body style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 25%, #0f3460 50%, #16213e 75%, #1a1a2e 100%); min-height: 100vh;">
    <div class="notification-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="mb-0"><i class="fas fa-bell me-3"></i>Order Notifications</h1>
                    <p class="mb-0 opacity-75">Manage all your order notifications</p>
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
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="mb-0">All Notifications</h5>
                            </div>
                            <div class="col-auto">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-outline-primary active" onclick="filterOrders('all')">All</button>
                                    <button type="button" class="btn btn-outline-warning" onclick="filterOrders('pending')">Pending</button>
                                    <button type="button" class="btn btn-outline-success" onclick="filterOrders('accepted')">Accepted</button>
                                    <button type="button" class="btn btn-outline-danger" onclick="filterOrders('cancelled')">Cancelled</button>
                                    <button type="button" class="btn btn-outline-info" onclick="filterOrders('flagged')">Flagged</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($orders->count() > 0)
                            <div id="notifications-container">
                                @foreach($orders as $order)
                                    <div class="notification-card card mb-3 status-{{ $order->status }}" data-status="{{ $order->status }}">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <h6 class="mb-0 me-3">Order #{{ $order->order_number }}</h6>
                                                        <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'accepted' ? 'success' : ($order->status == 'cancelled' ? 'danger' : 'info')) }}">
                                                            {{ ucfirst($order->status) }}
                                                        </span>
                                                    </div>
                                                    
                                                    <div class="order-details">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <strong>Customer:</strong> {{ $order->customer->name }}<br>
                                                                <strong>Product:</strong> {{ $order->product->name }}<br>
                                                                <strong>Quantity:</strong> {{ $order->quantity }}
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <strong>Total:</strong> Rs {{ number_format($order->total_amount, 2) }}<br>
                                                                <strong>Phone:</strong> {{ $order->customer_phone ?? 'N/A' }}<br>
                                                                <strong>Date:</strong> {{ $order->created_at->format('M d, Y H:i') }}
                                                            </div>
                                                        </div>
                                                        @if($order->delivery_address)
                                                            <div class="mt-2">
                                                                <strong>Address:</strong> {{ $order->delivery_address }}
                                                            </div>
                                                        @endif
                                                        @if($order->notes)
                                                            <div class="mt-2">
                                                                <strong>Notes:</strong> {{ $order->notes }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4 text-end">
                                    @if($order->status == 'pending')
                                        <div class="btn-group-vertical w-100" data-order-id="{{ $order->id }}">
                                            <button class="btn btn-success btn-action" onclick="acceptOrder({{ $order->id }})">
                                                <i class="fas fa-check me-1"></i>Accept
                                            </button>
                                            <button class="btn btn-danger btn-action" onclick="cancelOrder({{ $order->id }})">
                                                <i class="fas fa-times me-1"></i>Cancel
                                            </button>
                                            <button class="btn btn-warning btn-action" onclick="flagOrder({{ $order->id }})">
                                                <i class="fas fa-flag me-1"></i>Red Flag
                                            </button>
                                        </div>
                                    @else
                                        <div class="text-muted">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Order {{ $order->status }}
                                            @if($order->status == 'cancelled')
                                                <br><small>Stock restored</small>
                                            @elseif($order->status == 'flagged')
                                                <br><small>Due to circumstances</small>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-bell-slash fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">No notifications yet</h5>
                                <p class="text-muted">You'll see order notifications here when customers place orders.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // CSRF token setup is handled in individual fetch requests

        function acceptOrder(orderId) {
            console.log('Accept order clicked:', orderId);
            
            if (confirm('Are you sure you want to accept this order?')) {
                console.log('User confirmed accept order');
                
                // Show loading state
                const button = document.querySelector(`button[onclick="acceptOrder(${orderId})"]`);
                const originalText = button.innerHTML;
                button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
                button.disabled = true;
                
                fetch(`/orders/${orderId}/accept`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({})
                })
                .then(response => {
                    console.log('Accept response status:', response.status);
                    console.log('Accept response headers:', response.headers);
                    if (!response.ok) {
                        return response.text().then(text => {
                            console.log('Accept error response body:', text);
                            throw new Error(`HTTP error! status: ${response.status}, body: ${text}`);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Accept response data:', data);
                    
                    if (data.success) {
                        showToast('success', data.message || 'Order accepted successfully');
                        updateOrderCard(orderId, 'accepted');
                    } else {
                        showToast('error', data.error || 'Failed to accept order');
                        // Reset button on error
                        button.innerHTML = originalText;
                        button.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Accept order error:', error);
                    console.error('Error details:', error.message);
                    showToast('error', `Network error: ${error.message}`);
                    // Reset button on error
                    button.innerHTML = originalText;
                    button.disabled = false;
                });
            }
        }

        function cancelOrder(orderId) {
            console.log('Cancel order clicked:', orderId);
            
            if (confirm('Are you sure you want to cancel this order? Stock will be restored.')) {
                console.log('User confirmed cancel order');
                
                // Show loading state
                const button = document.querySelector(`button[onclick="cancelOrder(${orderId})"]`);
                const originalText = button.innerHTML;
                button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
                button.disabled = true;
                
                fetch(`/orders/${orderId}/cancel`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({})
                })
                .then(response => {
                    console.log('Cancel response status:', response.status);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Cancel response data:', data);
                    
                    if (data.success) {
                        showToast('success', data.message || 'Order cancelled successfully');
                        updateOrderCard(orderId, 'cancelled');
                    } else {
                        showToast('error', data.error || 'Failed to cancel order');
                        // Reset button on error
                        button.innerHTML = originalText;
                        button.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Cancel order error:', error);
                    showToast('error', 'Network error - please try again');
                    // Reset button on error
                    button.innerHTML = originalText;
                    button.disabled = false;
                });
            }
        }

        function flagOrder(orderId) {
            console.log('Flag order clicked:', orderId);
            
            if (confirm('Are you sure you want to flag this order as problematic? Stock will be restored.')) {
                console.log('User confirmed flag order');
                
                // Show loading state
                const button = document.querySelector(`button[onclick="flagOrder(${orderId})"]`);
                const originalText = button.innerHTML;
                button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
                button.disabled = true;
                
                fetch(`/orders/${orderId}/flag`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({})
                })
                .then(response => {
                    console.log('Flag response status:', response.status);
                    console.log('Flag response headers:', response.headers);
                    if (!response.ok) {
                        return response.text().then(text => {
                            console.log('Flag error response body:', text);
                            throw new Error(`HTTP error! status: ${response.status}, body: ${text}`);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Flag response data:', data);
                    
                    if (data.success) {
                        showToast('warning', data.message || 'Order flagged successfully');
                        updateOrderCard(orderId, 'flagged');
                    } else {
                        showToast('error', data.error || 'Failed to flag order');
                        // Reset button on error
                        button.innerHTML = originalText;
                        button.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Flag order error:', error);
                    console.error('Error details:', error.message);
                    showToast('error', `Network error: ${error.message}`);
                    // Reset button on error
                    button.innerHTML = originalText;
                    button.disabled = false;
                });
            }
        }

        function filterOrders(status) {
            const cards = document.querySelectorAll('.notification-card');
            const buttons = document.querySelectorAll('.btn-group button');
            
            // Update active button
            buttons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            
            // Filter cards
            cards.forEach(card => {
                if (status === 'all' || card.dataset.status === status) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function showToast(type, message) {
            const toastContainer = document.createElement('div');
            toastContainer.style.position = 'fixed';
            toastContainer.style.top = '20px';
            toastContainer.style.right = '20px';
            toastContainer.style.zIndex = '9999';
            
            const alertClass = type === 'success' ? 'alert-success' : type === 'warning' ? 'alert-warning' : 'alert-danger';
            const icon = type === 'success' ? 'check-circle' : type === 'warning' ? 'exclamation-triangle' : 'exclamation-circle';
            
            toastContainer.innerHTML = `
                <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                    <i class="fas fa-${icon} me-2"></i>${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;
            
            document.body.appendChild(toastContainer);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                if (toastContainer.parentNode) {
                    toastContainer.parentNode.removeChild(toastContainer);
                }
            }, 5000);
        }

        function updateOrderCard(orderId, newStatus) {
            const orderCard = document.querySelector(`[data-order-id="${orderId}"]`).closest('.notification-card');
            if (orderCard) {
                // Update status badge
                const statusBadge = orderCard.querySelector('.badge');
                const statusColors = {
                    'accepted': 'bg-success',
                    'cancelled': 'bg-danger', 
                    'flagged': 'bg-info'
                };
                
                statusBadge.className = `badge ${statusColors[newStatus]}`;
                statusBadge.textContent = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
                
                // Update card border color
                orderCard.className = orderCard.className.replace(/status-\w+/, `status-${newStatus}`);
                orderCard.dataset.status = newStatus;
                
                // Replace action buttons with status message
                const actionsDiv = orderCard.querySelector('.btn-group-vertical');
                if (actionsDiv) {
                    const statusMessage = newStatus === 'cancelled' ? 'Order cancelled<br><small>Stock restored</small>' : 
                                        newStatus === 'flagged' ? 'Order flagged<br><small>Due to circumstances</small>' :
                                        'Order accepted';
                    actionsDiv.parentElement.innerHTML = `<div class="text-muted"><i class="fas fa-info-circle me-1"></i>${statusMessage}</div>`;
                }
            }
        }
        
        // Auto-refresh notifications every 30 seconds
        setInterval(() => {
            location.reload();
        }, 30000);
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
