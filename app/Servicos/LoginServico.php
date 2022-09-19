<?php 
namespace App\Servicos;

use App\Models\Grupo;
use App\Models\Login;
use App\Models\User;
use App\Utils\ApiCache;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LoginServico{
    protected static $sessao;
    protected static $admin;

    const SlugAdmin = 'administradores';

    public static function ObtemSessao($token){
        $chave = ApiCache::GeraChaveRequest(Array(
            'tk' => $token
        ));
        if(ApiCache::Existe($chave)){
            return ApiCache::Obtem($chave);
        }
        $login = Login::query()
            ->where('api_token', '=', $token)
            ->first();

        ApiCache::AddCache($chave, $login);
        return $login;
    }

    public static function RemoveTokenSessao($token){
        $chave = ApiCache::GeraChaveRequest(Array(
            'tk' => $token
        ));
        if(ApiCache::Existe($chave)){
            return ApiCache::Remove($chave);
        }
    }

    private static function ResetaValidadores(){
        self::$admin = false;
    }

    public static function ObtemGrupoUsuario($usuario_id){
        return 
        Grupo::query()
            ->join('usuario_grupo', 'usuario_grupo.grupo_id', '=', 'grupo.id')
            ->where('usuario_grupo.usuario_id', '=', $usuario_id)
            ->whereNull('usuario_grupo.deleted_at')
            ->whereNull('grupo.deleted_at')
            ->get([
                'grupo.id',
                'grupo.slug'
            ]);
    }

    private static function AtualizaValidadores($sessao){
        self::$sessao = $sessao;
        $grupos = static::ObtemGrupoUsuario($sessao['user_id']);
        static::ResetaValidadores();
        foreach($grupos as $grupo){
            if(strcasecmp($grupo->slug, static::SlugAdmin) == 0){
                self::$admin = true;
            }
        }
    }

    public static function UsuarioAdmin($sessao){
        if(self::$sessao && strcasecmp(self::$sessao['api_token'], $sessao['api_token']) == 0){
            return self::$admin;
        }
        static::AtualizaValidadores($sessao);
        return self::$admin;
    }

    public static function ObtemUsuariosSlug($slug){
        return DB::select("SELECT users.id, users.name, users.email, users.path_avatar From users
        inner join usuario_grupo ON usuario_grupo.usuario_id = users.id
        inner join grupo ON grupo.id = usuario_grupo.grupo_id
        where grupo.slug = '$slug'
        and users.deleted_at is null
        and usuario_grupo.deleted_at is null");
    }

    public static function ObtemUsuariosSlugEloquent(Request $request, $slug){
        $camposRetorno = [
            'users.id',
            'users.name',
            'users.email',
            'users.path_avatar'
        ];
        $consulta = User::query()
            ->join('usuario_grupo', 'usuario_grupo.usuario_id', '=', 'users.id')
            ->join('grupo', 'grupo.id', '=', 'usuario_grupo.grupo_id')
            ->where('grupo.slug', '=', $slug)
            ->whereNull('users.deleted_at')
            ->whereNull('usuario_grupo.deleted_at');
        return $consulta->paginate(
            intval($request->get('per_page', 20)),
            $camposRetorno
        );
    }

    public static function ObtemUsuariosAdministradores(){
        return static::ObtemUsuariosSlug(LoginServico::SlugAdmin);
    }
}