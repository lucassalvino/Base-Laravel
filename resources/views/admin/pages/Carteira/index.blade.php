@extends('admin.includes.BaseseViews.index',
[
'titulo' => 'Carteiras',
'urlNovo' => '#',
'urlEditar' => '#',
'urlDeletar' => '#',
'urlRestaurar' => '#',
'menuativo' => 'menu-carteiras',
'mostrarBtnCadastrar' => false,
'mostrarExclusao' => false,
'ItensHeader' =>
    [
        [
            'nome' => "Nome",
            'index' => 'name'
        ],
        [
            'nome' => 'Saldo Disponível',
            'index' => 'saldo_disponivel'
        ],
        [
            'nome' => 'Saldo a Receber',
            'index' => 'saldo_a_receber'
        ],
        [
            'nome' => 'Saldo bloqueado',
            'index' => 'saldo_bloqueado'
        ]
    ]
])

@section('opcoes_adicionais')
    <a href="#" title="Transações" class="link-transacoes">
        <i class="fas fa-list"></i>
    </a>
@endsection

@section('scripts_adicionais')
<script>
    $(document).ready(function(){
        $('.link-transacoes').on("click", function(){
            var id = $($(this).parent()).data("id");
            window.location.href = "{{route('admin:movimentacoes.carteira.index', '')}}/" + id;
        });
    });
</script>
@endsection
