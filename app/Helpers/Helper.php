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
        $kategori = "";
        if ($lila > $standar) {
            $kategori = "Tidak Kek";
        } else {
            $kategori = "Kek";
        }
        return $kategori;
    }
}

if (!function_exists('gen_no_tiket')) {
    function gen_no_tiket()
    {
        $no = str_pad(1, 3, '0', STR_PAD_LEFT);

        $terakhir = \App\Models\FormGarageShow::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->orderBy('created_at', 'desc')->first();

        if ($terakhir) {
            $no = str_pad((int) substr($terakhir->no_tiket, -3) + 1, 3, 0, STR_PAD_LEFT);
        }

        return 'GRGSHW-' . $no;
    }
}
