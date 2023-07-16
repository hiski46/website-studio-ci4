<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Breadcrumb extends BaseConfig
{
    public $listUrl = [
        'auth'          => 'auth.index_heading',
        'create_user'   => 'auth.create_user_heading',
        'create_group'  => 'auth.create_group_heading',
        'edit_user'     => 'auth.edit_user_heading',
        'deactivate'    => 'auth.deactivate_heading',
        'edit_group'    => 'auth.edit_group_heading',
        'paket'         => 'Daftar Shop',
    ];
}
