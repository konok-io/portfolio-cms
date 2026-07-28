@extends('admin.layouts.app')

@section('title', 'Custom Pages - Admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">
                <i class="fa-solid fa-file-lines me-2 text-primary"></i>
                Custom Pages
            </h1>
            <a href="{{ route('admin.custom-pages.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus me-2"></i>Create Page
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            @if($pages->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Title</th>
                                <th>Slug</th>
                                <th style="width: 100px">Template</th>
                                <th style="width: 100px">Published</th>
                                <th style="width: 120px">Menu</th>
                                <th style="width: 120px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pages as $page)
                                <tr>
                                    <td>
                                        <strong>{{ $page->title }}</strong>
                                    </td>
                                    <td>
                                        <code>/{{ $page->slug }}</code>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ ucfirst($page->template) }}</span>
                                    </td>
                                    <td>
                                        @if($page->is_published)
                                            <span class="badge bg-success">Yes</span>
                                        @else
                                            <span class="badge bg-secondary">Draft</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($page->show_in_header)
                                            <span class="badge bg-info me-1">Header</span>
                                        @endif
                                        @if($page->show_in_footer)
                                            <span class="badge bg-info">Footer</span>
                                        @endif
                                        @if(!$page->show_in_header && !$page->show_in_footer)
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('page.show', $page) }}" target="_blank" class="btn btn-outline-secondary">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.custom-pages.edit', $page) }}" class="btn btn-outline-primary">
                                                <i class="fa-solid fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.custom-pages.destroy', $page) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Delete this page?')">
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
                    <i class="fa-solid fa-file-lines fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No pages found. Create your first page!</p>
                    <a href="{{ route('admin.custom-pages.create') }}" class="btn btn-primary">
                        <i class="fa-solid fa-plus me-2"></i>Create Page
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
