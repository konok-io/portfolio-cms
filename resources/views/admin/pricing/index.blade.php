@extends('admin.layouts.app')

@section('title', 'Pricing Plans - Admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">
                <i class="fa-solid fa-tags me-2 text-primary"></i>
                Pricing Plans
            </h1>
            <a href="{{ route('admin.pricing.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus me-2"></i>Add Plan
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            @if($plans->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 50px">#</th>
                                <th>Name</th>
                                <th>Monthly Price</th>
                                <th>Yearly Price</th>
                                <th style="width: 100px">Highlighted</th>
                                <th style="width: 100px">Status</th>
                                <th style="width: 120px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($plans as $plan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <strong>{{ $plan->name }}</strong>
                                        @if($plan->badge)
                                            <br><span class="badge bg-info">{{ $plan->badge }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $plan->formatPrice($plan->monthly_price) }}</td>
                                    <td>{{ $plan->formatPrice($plan->yearly_price) }}</td>
                                    <td>
                                        @if($plan->is_highlighted)
                                            <span class="badge bg-warning">Yes</span>
                                        @else
                                            <span class="badge bg-secondary">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($plan->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.pricing.edit', $plan) }}" class="btn btn-outline-primary">
                                                <i class="fa-solid fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.pricing.destroy', $plan) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this plan?')">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fa-solid fa-tags fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No pricing plans found. Create your first plan!</p>
                    <a href="{{ route('admin.pricing.create') }}" class="btn btn-primary">
                        <i class="fa-solid fa-plus me-2"></i>Add Plan
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
