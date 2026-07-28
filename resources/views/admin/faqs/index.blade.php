@extends('admin.layouts.app')

@section('title', 'FAQs - Admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">
                <i class="fa-solid fa-question-circle me-2 text-primary"></i>
                Frequently Asked Questions
            </h1>
            <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus me-2"></i>Add FAQ
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            @if($faqs->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 50px">#</th>
                                <th>Question</th>
                                <th>Answer</th>
                                <th style="width: 100px">Order</th>
                                <th style="width: 100px">Status</th>
                                <th style="width: 120px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($faqs as $faq)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <strong>{{ Str::limit($faq->question, 80) }}</strong>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ Str::limit(strip_tags($faq->answer), 100) }}</small>
                                    </td>
                                    <td>{{ $faq->sort_order }}</td>
                                    <td>
                                        @if($faq->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-outline-primary">
                                                <i class="fa-solid fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this FAQ?')">
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
                    <i class="fa-solid fa-question-circle fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No FAQs found. Create your first FAQ!</p>
                    <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary">
                        <i class="fa-solid fa-plus me-2"></i>Add FAQ
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
