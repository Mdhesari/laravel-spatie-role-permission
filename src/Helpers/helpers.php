<?php

/**
 * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
 */
function get_permission_key(): string
{
    return config('laravel-spatie-role-permission::permission_key');
}

function get_user_model()
{
    return app(config('laravel-spatie-role-permission::user_model'));
}