@if($errors->any())
    <div class="alert alert-solid-danger alert-dismissible" role="alert">
        <h6 class="alert-heading mb-1"><i class="bx bx-xs bx-error-circle align-top me-2"></i> Lỗi!</h6>

        <ul class="mb-0">
            @foreach($errors->all() as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
