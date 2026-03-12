@extends('admin.layout')

@section('title', 'Orders Management')
@section('page-title', 'Orders Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="table-custom">
                <div class="p-4 border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">All Orders</h5>
                        <div>
                            <span class="badge bg-primary me-2">Total: {{ $orders->total() }}</span>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Shopkeeper</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle p-2 me-3">
                                            <i class="fas fa-user text-muted"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $order->customer->name ?? 'N/A' }}</h6>
                                            <small class="text-muted">{{ $order->customer->email ?? 'N/A' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $order->shopkeeper->name ?? 'N/A' }}</td>
                                <td>{{ $order->product->name ?? 'N/A' }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>Rs. {{ number_format($order->total_amount, 2) }}</td>
                                <td>
                                    <span class="badge badge-custom 
                                        @if($order->status == 'pending') bg-warning
                                        @elseif($order->status == 'accepted') bg-info
                                        @elseif($order->status == 'preparing') bg-primary
                                        @elseif($order->status == 'out_for_delivery') bg-secondary
                                        @elseif($order->status == 'delivered') bg-success
                                        @elseif($order->status == 'cancelled') bg-danger
                                        @elseif($order->status == 'flagged') bg-dark
                                        @else bg-secondary
                                        @endif">
                                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <i class="fas fa-shopping-cart fa-2x text-muted mb-3 d-block"></i>
                                    <p class="text-muted">No orders found</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($orders->hasPages())
                <div class="p-4 border-top">
                    {{ $orders->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
