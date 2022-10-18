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

