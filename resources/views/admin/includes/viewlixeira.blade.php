<style>
.container-lixeira{
    display: flex;
    width: 100%;
    justify-content: space-between;
    align-items: center;
    font-size: 1rem;
}
.ocultar_trash{
    display: none;
}
.d-flex{
    display: flex;
}
.form-busca{
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    padding-right: 10px;
}
#aplicar_filtros{
    border: none;
    outline: none!important;
    border-radius: 2px;
    padding: 5px 20px;
}
.delete{
    color: red;
}
input, select {
    height: 30px!important;
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
        <div class="container-lixeira">
            <div class="d-flex form-busca flex-wrap">
                <div class="d-flex">
                    <div class="pr-1">
                        Mostrar
                    </div>
                    <select name="qtd_page" id="qtd_page" onchange="reloadPage()">
                        <option value="10" {{$por_pagina == 10? 'selected' : ''}}>10</option>
                        <option value="20" {{$por_pagina == 20? 'selected' : ''}}>20</option>
                        <option value="30" {{$por_pagina == 30? 'selected' : ''}}>30</option>
                        <option value="40" {{$por_pagina == 40? 'selected' : ''}}>40</option>
                        <option value="50" {{$por_pagina == 50? 'selected' : ''}}>50</option>
                        <option value="100" {{$por_pagina == 100? 'selected' : ''}}>100</option>
                        <option value="150" {{$por_pagina == 150? 'selected' : ''}}>150</option>
                    </select>
                    <div class="pl-1">
                        registros
                    </div>
                </div>
                <div class="d-flex m-1">
                    <div class="d-flex pr-3">
                        <input type="text" value="{{isset($_GET['search'])?$_GET['search']:''}}" placeholder="Pesquisar" id="texto_busca">
                    </div>
                    <div class="d-flex">
                        <button id="aplicar_filtros">Buscar</button>
                    </div>
                </div>
            </div>
            <div class="d-flex m-1">
                <a href="#" title="Mostrar Lixeira" id="acao-click-view-lixeira">
                    <i class="fas fa-trash-alt"></i>
                </a>
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