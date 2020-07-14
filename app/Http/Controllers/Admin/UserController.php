<?php

namespace App\Http\Controllers\Admin;


class UserController
{
    public function index(){

        $data = [];
        return view('admin.users.index', $data);
    }


}