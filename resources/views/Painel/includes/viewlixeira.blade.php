<style>
.ocultar_trash{
    display: none;
}
a{
    text-decoration:none!important;
}

</style>
<?php 
$por_pagina = 20;
if(isset($_GET['per_page'])){
    $por_pagina = intval($_GET['per_page']);
}
?>
<div class="card">
    <div class="card-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="d-flex gap-2 align-items-center">
                        <p class="m-0">Monstrar</p>
                        <div class="col-4">
                            <select name="qtd_page" class="form-select" id="qtd_page" onchange="reloadPage()">
                                <option value="10" {{$por_pagina == 10? 'selected' : ''}}>10</option>
                                <option value="20" {{$por_pagina == 20? 'selected' : ''}}>20</option>
                                <option value="30" {{$por_pagina == 30? 'selected' : ''}}>30</option>
                                <option value="40" {{$por_pagina == 40? 'selected' : ''}}>40</option>
                                <option value="50" {{$por_pagina == 50? 'selected' : ''}}>50</option>
                                <option value="100" {{$por_pagina == 100? 'selected' : ''}}>100</option>
                                <option value="150" {{$por_pagina == 150? 'selected' : ''}}>150</option>
                            </select>
                        </div>
                        <p class="m-0">Registros</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex gap-2 align-items-center justify-content-end">
                        <div class="d-flex col-6">
                            <input type="text" value="{{isset($_GET['search'])?$_GET['search']:''}}" placeholder="Pesquisar" id="texto_busca" class="form-control">
                        </div>
                        <div class="d-flex">
                            <button id="aplicar_filtros" class="btn"><i class="bi bi-search"></i> Buscar</button>
                        </div>
                        <div class="d-flex">
                            <a href="#" title="Mostrar Lixeira" id="acao-click-view-lixeira" class="btn">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

function reloadPage (){
    var url = new URL(window.location.href);
    url.searchParams.set('per_page', document.getElementById("qtd_page").value);
    url.searchParams.set('search', document.getElementById("texto_busca").value);
    window.location.href = url.toString();
}

document.getElementById('acao-click-view-lixeira').addEventListener("click", function(){
    var url = new URL(window.location.href);
    if(url.searchParams.has('trashed_only')){
        url.searchParams.delete('trashed_only');
    }else{
        url.searchParams.set('trashed_only', 1);
    }
    url.searchParams.delete('page');
    window.location.href = url.toString();
});

document.getElementById('aplicar_filtros').addEventListener('click', function(){
    reloadPage();
});
</script>