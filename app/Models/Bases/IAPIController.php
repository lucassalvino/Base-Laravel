<?php 
namespace App\Models\Bases;
use Illuminate\Http\Request;
interface IAPIController {
    public function Cadastra (Request $request);
    public function Listagem (Request $request);
    public function Detalhado(Request $request, $id);
    public function Atualiza (Request $request, $id);
    public function Deleta (Request $request, $id);
    public function Restaura (Request $request, $id);
}