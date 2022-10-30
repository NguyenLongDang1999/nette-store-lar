@if($type === config('constants.UPLOAD_ONCE'))
    <div class="d-flex align-items-start align-items-sm-center gap-4">
        {{ html()->img(showImage($path, $value), 'Image')->class('d-block rounded')->id('uploaded-image')->attributes(['width' => 150, 'height' => 150]) }}

        <div class="button-wrapper">
            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                <span class="d-none d-sm-block">Chọn Hình</span>
                <i class="bx bx-upload d-block d-sm-none"></i>

                {{ html()->file('image_uri')->acceptImage()->class('image-file-input')->id('upload')->attribute('hidden', 'hidden') }}
            </label>

            <button type="button" class="btn btn-label-secondary image-file-reset mb-4">
                <i class="bx bx-reset d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Làm Mới</span>
            </button>

            <p class="mb-0">Chấp nhận ảnh JPG, GIF or PNG.</p>

            @if($errors->has($name))
                <div class="invalid-feedback d-block">{{ $errors->first($name) }}</div>
            @endif
        </div>
    </div>
@endif
