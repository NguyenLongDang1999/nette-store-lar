$(function () {
    // Variables
    let uploadedImage = $('#uploaded-image')

    const bootstrapSelect = $('.bootstrap-select'),
        imageUploader = $('.image-uploader'),
        imageFileInput = $('.image-file-input'),
        imageFileReset = $('.image-file-reset'),
        name = $('#name'),
        slug = $('#slug')

    // Plugins
    if (bootstrapSelect.length) {
        bootstrapSelect.selectpicker()
    }

    // Methods
    if (uploadedImage) {
        const resetImage = uploadedImage.attr('src')

        imageFileInput.change(function () {
            const getFiles = $(this).prop('files')[0]

            if (getFiles) {
                uploadedImage.attr('src', window.URL.createObjectURL(getFiles))
            }
        })

        imageFileReset.click(function () {
            imageFileInput.val('')
            uploadedImage.attr('src', resetImage)
        })
    }

    name ? name.on('input', () => convertToSlug()) : ''
})
