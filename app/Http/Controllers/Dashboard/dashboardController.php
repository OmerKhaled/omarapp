<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    
    public function __construct(){

        
        $this->middleware(['role:admin|super_admin'])->only('index');


    }
    public function index(){
        return view("dashboard.index");
    }
}
