<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public $appData;

    public function __construct()
    {
        $this->appData = require(app_path('appData.php'));
    }

    public function showData()
    {
        return response()->json($this->appData);
    }
}
