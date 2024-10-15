<?php
namespace App\Http\Controllers\Web\CMS;

use App\Http\Controllers\Controller;
use App\Models\CMS\Banners;
use App\Models\CMS\SEO;
use App\Utils\ApiCache;
use App\Utils\ArquivosStorage;
use App\Utils\BaseRetornoApi;
use Illuminate\Http\Request;

class CMSController extends Controller
{
    public function seo() {
        $seo = SEO::query()->first();
        if($seo){
            $seo->img_compartilhamento = ArquivosStorage::GetUrlView($seo->img_compartilhamento);
            $seo->img_favicon = ArquivosStorage::GetUrlView($seo->img_favicon);
        }
        return view('admin.cms.seo', compact('seo'));
    }

    public function cadastraseo(Request $request){
        $seo = SEO::query()->first();
        if($seo){
            return SEO::AtualizaElemento($request, $seo->id);
        }else{
            return SEO::CadastraElemento($request);
        }
    }

    public function banner(){
        $banners = Banners::ObtemBannersVisualizar();
        return view('admin.cms.banners', compact('banners'));
    }

    public function cadastrabanner(Request $request){
        $dados = $request->all();
        $desktop = '';
        $mobile = '';
        if($dados['path_desktop_base_64'] && $dados['tipo_path_desktop']){
            $desktop = Banners::SalvaImagem($dados['path_desktop_base_64'], $dados['tipo_path_desktop']);
        }
        if($dados['path_mobile_base_64'] && $dados['tipo_path_mobile']){
            $mobile = Banners::SalvaImagem($dados['path_mobile_base_64'], $dados['tipo_path_mobile']);
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
            if($desktop != ''){
                $banner->path_desktop = $desktop;
            }
            if($mobile != ''){
                $banner->path_mobile = $mobile;
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
                'path_desktop' => $desktop,
                'path_mobile' => $mobile,
                'url' => $dados['url']
            ));
        }
        $chave = ApiCache::GeraChaveRequest(['TODOS_BANNERS']);
        ApiCache::LimpaCahce($chave);
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
                $banner->path_desktop = ArquivosStorage::GetUrlView($banner->path_desktop);
                $banner->path_mobile = ArquivosStorage::GetUrlView($banner->path_mobile);
            }
        }
        return view('admin.cms.cadastrabanner', compact('banner'));
    }
}

