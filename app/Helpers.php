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
    $publicPath = public_path($path);
    if (!file_exists($publicPath)) {
        mkdir($publicPath, 0755, true);
    }

    $ext = 'jpg';
    $fileName = $slug . '.' . $ext;
    $destinationPath = $publicPath . $fileName;
    Image::make($imageURL->getRealPath())->encode($ext, '90')->resize($size['width'], $size['height'])->save($destinationPath);

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

function adminMenuList(): array
{
    return [
        'manage-dashboard' => [
            'title' => 'Thống kê',
            'content' => [
                [
                    'title' => 'Trang thống kê',
                    'icon' => 'bx bx-home-circle',
                    'href' => route('admin.dashboard')
                ]
            ]
        ],
        'manage-product' => [
            'title' => 'Sản phẩm',
            'content' => [
                [
                    'title' => 'Quản lý danh mục',
                    'icon' => 'bx bx-category',
                    'href' => route('admin.category.index')
                ],
                [
                    'title' => 'Quản lý thương hiệu',
                    'icon' => 'bx bx-store',
                    'href' => route('admin.brand.index')
                ],
                [
                    'title' => 'Quản lý sản phẩm',
                    'icon' => 'bx bxl-product-hunt',
                    'href' => route('admin.brand.index')
                ]
            ]
        ]
    ];
}
