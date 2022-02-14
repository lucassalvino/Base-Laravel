<?php
namespace App\Http\Controllers\Web\admin;

use Illuminate\Http\Request;

class DashBoardController extends BaseAdminController{

    public function Index(Request $request) {
        return view('admin.home');
    }
    public function EmConstrucao(Request $request) {
        return view('admin.construindo');
    }
}
