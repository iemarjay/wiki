<?php

namespace App\Controllers;

use App\Classes\Helper;

class Pages
{
    public function index(): void
    {
        Helper::view('index');
    }

    public function confirmed(): void
    {
        Helper::view('confirmed');
    }

    public function cancel(): void
    {
        Helper::view('cancel');
    }

}
