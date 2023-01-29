<?php
namespace App\Http\Controllers\Web\admin;

use Illuminate\Http\Request;

class ChamadaJobsController extends BaseAdminController{
    public function ChamadaJobs(Request $request){
        return view('admin.pages.Monitoramento.ChamadaJobs');
    }
}
