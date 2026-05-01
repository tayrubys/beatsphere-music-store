<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        if (!session()->get('giris_yapildi')) {
            return redirect()->to('/login');
        }

        if (session()->get('rol') != 'admin') {
            return redirect()->to('/');
        }

        return view('admin/index');
    }
}