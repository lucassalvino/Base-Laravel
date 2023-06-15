<?php

namespace App\Jobs;

use App\Utils\AuxCarbon;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeletaRegistroLogins implements ShouldQueue{
    public $timeout = 0;
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(){
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(){
        try{
           $agora = AuxCarbon::ObtenhaDataTimeFIltro(date("Y-m-d H:i:s"));
           DB::statement("DELETE FROM login where ((created_at + interval '2 day') < ('$agora'))");
        }catch(Exception $erro){
            Log::error($erro);
        }
    }
}
