<?php

function optionStatus(): array
{
    return [
        '' => '[-- Chọn trạng thái --]',
        config('constants.STATUS_ACTIVE') => __('trans.status_active'),
        config('constants.STATUS_INACTIVE') => __('trans.status_inactive')
    ];
}

function optionPopular(): array
{
    return [
        '' => '[-- Chọn độ phổ biến --]',
        config('constants.POPULAR_ACTIVE') => __('trans.popular_active'),
        config('constants.POPULAR_INACTIVE') => __('trans.popular_inactive')
    ];
}

function imageManipulation($path, $slug, $imageURL, $size): string
{
    $ext = 'webp';
    $fileName = $slug . '.' . $ext;
    $destinationPath = public_path($path) . $fileName;
    $imageResize = Image::make($imageURL->getRealPath())->encode($ext, '90')->resize($size['width'], $size['height'])->save($destinationPath);
    return $fileName;
}

function removeImageFromStorage($path, $fileName): void
{
    $destinationPath = public_path($path) . $fileName;
    if (file_exists($destinationPath) && !is_null($fileName)) {
        unlink($destinationPath);
    }
}

/**
 * @param $path
 * @param $url
 * @return string
 */
function showImage($path, $url): string
{
    return asset($url ? $path . $url : config('constants.PATH_DEFAULT'));
}
