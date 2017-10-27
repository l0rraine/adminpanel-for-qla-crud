<?php

namespace Qla\AdminPanel\app\Http\Controllers;

use App\Http\Controllers\Controller;


class AdminPanelController extends Controller
{

    public function getIndex()
    {
        return view('adminpanel::index');
    }

}