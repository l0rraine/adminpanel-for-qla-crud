<?php

namespace Qla\Manager\app\Http\Controllers;

use App\Http\Controllers\Controller;


class ManagerController extends Controller
{

    public function getIndex()
    {
        return view('manager::index');
    }

}