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

    // Functions
    function convertToSlug() {
        let str = name.val()
        str = str.toLowerCase()

        str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a')
        str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e')
        str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i')
        str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o')
        str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u')
        str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y')
        str = str.replace(/(đ)/g, 'd')
        str = str.replace(/([^0-9a-z-\s])/g, '')
        str = str.replace(/(\s+)/g, '-')
        str = str.replace(/^-+/g, '')
        str = str.replace(/-+$/g, '')

        return slug.val(str)
    }
})
