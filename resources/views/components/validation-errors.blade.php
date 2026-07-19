@if($errors->any())
    <div class="alert alert-danger alert-auto-dismiss">
        <strong>Please fix the following:</strong>
        <ul class="mb-0 mt-2 ps-3">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
