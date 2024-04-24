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

if (!function_exists('get_code_group')) {
    function get_code_group($code)
    {
        return \App\Models\ComCode::where('code_group', $code)->pluck('code_nm', 'code_cd');
    }
}

if (!function_exists('hitung_lila')) {
    function hitung_lila($lila, $standar)
    {
        $hasil = round(($lila / $standar) * 100, 1);
        $kategori = "";
        if ($hasil > 120) {
            $kategori = "Obesitas";
        } else if ($hasil > 110) {
            $kategori = "Overweight";
        } else if ($hasil > 85) {
            $kategori = "Gizi Baik";
        } else if ($hasil > 70) {
            $kategori = "Gizi Kurang";
        } else {
            $kategori = "Gizi Buruk";
        }
        return $kategori;
    }
}
