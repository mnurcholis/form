<?php

if (!function_exists('get_role_user')) {
    function get_role_user()
    {
        return \Spatie\Permission\Models\Role::pluck('name', 'name');
    }
}

if (!function_exists('get_permission_user')) {
    function get_permission_user()
    {
        return \Spatie\Permission\Models\Permission::pluck('name', 'name');
    }
}