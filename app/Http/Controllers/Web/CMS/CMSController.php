<?php
namespace App\Http\Controllers\Web\CMS;

use App\Http\Controllers\Controller;
use App\Models\CMS\Banners;
use App\Models\CMS\SEO;
use App\Utils\ArquivosStorage;
use App\Utils\BaseRetornoApi;
use Illuminate\Http\Request;

class CMSController extends Controller
{
    public function seo() {
        $seo = SEO::query()->first();
        return view('admin.cms.seo', compact('seo'));
    }

    public function cadastraseo(Request $request){
        $dados = $request->all();
        $seo = SEO::query()->first();
        if($seo){
            $seo->descricao = $dados['descricao'];
            $seo->titulo = $dados['titulo'];
            $seo->url = $dados['url'];
            $seo->palavras_chave = $dados['palavras_chave'];
            $seo->script_tracking = $dados['script_tracking'];
            $seo->save();
        }else{
            SEO::create(Array(
                'descricao' => $dados['descricao'],
                'titulo' => $dados['titulo'],
                'url' => $dados['url'],
                'palavras_chave' => $dados['palavras_chave'],
                'script_tracking' => $dados['script_tracking'],
            ));
        }
        return BaseRetornoApi::GetRetornoSucesso("Dados de SEO salvos com sucesso");
    }

    public function banner(){
        $banners = Banners::ObtemBannersVisualizar();
        return view('admin.cms.banners', compact('banners'));
    }

    public function cadastrabanner(Request $request){
        $dados = $request->all();
        $descktop = '';
        $mobile = '';
        if($dados['patch_descktop_base_64'] && $dados['tipo_patch_descktop']){
            $descktop = Banners::SalvaImagem($dados['patch_descktop_base_64'], $dados['tipo_patch_descktop']);
        }
        if($dados['patch_mobile_base_64'] && $dados['tipo_patch_mobile']){
            $mobile = Banners::SalvaImagem($dados['patch_mobile_base_64'], $dados['tipo_patch_mobile']);
        }
        if( strcasecmp($dados['id'], "00000000-0000-0000-0000-000000000000") != 0 ){
            $banner = Banners::query()->where('id', '=', $dados['id'])->first();
            if(!$banner){
                return BaseRetornoApi::GetRetorno404("");
            }
            $banner->titulo = $dados['titulo'];
            $banner->cortitulo = $dados['cortitulo'];
            $banner->subtitulo = $dados['subtitulo'];
            $banner->corsubtitulo = $dados['corsubtitulo'];
            $banner->obs = $dados['obs'];
            $banner->corobs = $dados['corobs'];
            $banner->url = $dados['url'];
            if($descktop != ''){
                $banner->patch_descktop = $descktop;
            }
            if($mobile != ''){
                $banner->patch_mobile = $mobile;
            }
            $banner->save();
        }else{
            Banners::create(Array(
                'titulo' => $dados['titulo'],
                'cortitulo' => $dados['cortitulo'],
                'subtitulo' => $dados['subtitulo'],
                'corsubtitulo' => $dados['corsubtitulo'],
                'obs' => $dados['obs'],
                'corobs' => $dados['corobs'],
                'patch_descktop' => $descktop,
                'patch_mobile' => $mobile,
                'url' => $dados['url']
            ));
        }
        return BaseRetornoApi::GetRetornoSucesso("Banner cadastrado com sucesso");
    }

    public function deletabanner(Request $request, $id){
        Banners::query()->where('id', '=',$id)->delete();
        return BaseRetornoApi::GetRetornoSucesso("Registro deletado com sucesso");
    }

    public function cadastrarbanner(Request $request, $id){
        $banner = null;
        if(strcasecmp($id, '00000000-0000-0000-0000-000000000000') != 0){
            $banner = Banners::query()->where('id', '=', $id)->first();
            if($banner){
                $banner->patch_descktop = ArquivosStorage::GetUrlView($banner->patch_descktop);
                $banner->patch_mobile = ArquivosStorage::GetUrlView($banner->patch_mobile);
            }
        }
        return view('admin.cms.cadastrabanner', compact('banner'));
    }
}

