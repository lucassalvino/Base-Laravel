<div class="row margint15">
    <div class="col-lg-12">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <div>
                <strong>Atenção!</strong> @if(isset($retorno)) {{$retorno['mensagem']}} @endif
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
</div>