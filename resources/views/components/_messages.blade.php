@if (session()->has(config('constants.MESSAGE_SUCCESS')))
    <div class="alert alert-solid-success alert-dismissible" role="alert">
        <h6 class="alert-heading mb-1"><i class="bx bx-xs bx-desktop align-top me-2"></i>Success!</h6>
        <span>{{ session()->get(config('constants.MESSAGE_SUCCESS')) }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div
    class="bs-toast toast toast-placement-ex top-0 end-0 m-2"
    role="alert"
    aria-live="assertive"
    aria-atomic="true"
    data-bs-delay="4000"
>
    <div class="toast-header text-white" id="toast-type">
        <div id="toast-result"></div>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>
