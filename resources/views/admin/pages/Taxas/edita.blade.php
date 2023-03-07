@extends('admin.includes.BaseseViews.novo',[
    'urlSubmit' => route('taxasusuario.api.editar',  $item->id),
    'titulo' => 'Atualização de Taxas',
    'menuativo' => 'menu-configuracao',
    'textoBotao' => 'Atualizar',
    'verboSubmissao' => 'PUT'
])

@section('input_form')

<?php
    $taxas = json_decode($item->taxas, true);
    $TaxasPadrao = App\Models\Produtor\UsuarioTaxa::$TaxasParcelamentoPadrao;
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="usuario_id">Usuário</label>
                <select name="usuario_id" id="usuario_id" class="select2" disabled>
                    @foreach($itensView['usuarios'] as $key => $value)
                        <option value="{{$value->id}}"
                        @if( strcasecmp($value->id, $item->usuario_id) == 0)
                            {{'selected'}}
                        @endif
                        > {{$value->name}} </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <hr> <label for="">Taxas Cartão de crédito</label>
        </div>
    </div>
    <div class="row">
         <div class="col-lg-6">
            <div class="form-group">
                <label>Taxa Plataforma (%)</label>
                <input type="number" name="taxas[taxaplataforma]"
                    class="form-control"
                    placeholder="Digite a taxa da plataforma para esse produtor"
                    value=
                        @if(array_key_exists('taxaplataforma', $taxas))
                            "{{ $taxas['taxaplataforma'] }}"
                        @else
                            "{{App\Models\Produtor\UsuarioTaxa::$taxaPlataformaPadrao}}"
                        @endif
                    step="0.01">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Taxa fixa (R$)</label>
                <input type="number" name="taxas[taxafixa]"
                    class="form-control"
                    placeholder="Digite a taxa da plataforma para esse produtor"
                    value=
                        @if(array_key_exists('taxafixa', $taxas))
                            "{{ $taxas['taxafixa'] }}"
                        @else
                            "{{App\Models\Produtor\UsuarioTaxa::$taxaFixaPadrao}}"
                        @endif
                    step="0.50">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <hr> <label for="">Taxas PIX</label>
        </div>
    </div>
    <div class="row">
         <div class="col-lg-6">
            <div class="form-group">
                <label>Taxa Plataforma (%)</label>
                <input type="number" name="taxas[taxaplataforma_pix]"
                    class="form-control"
                    placeholder="Digite a taxa da plataforma para esse produtor"
                    value=
                        @if(array_key_exists('taxaplataforma_pix', $taxas))
                            "{{ $taxas['taxaplataforma_pix'] }}"
                        @else
                            "{{App\Models\Produtor\UsuarioTaxa::$taxaPlataformaPadrao}}"
                        @endif
                    step="0.01">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Taxa fixa (R$)</label>
                <input type="number" name="taxas[taxafixa_pix]"
                    class="form-control"
                    placeholder="Digite a taxa da plataforma para esse produtor"
                    value=
                        @if(array_key_exists('taxafixa_pix', $taxas))
                            "{{ $taxas['taxafixa_pix'] }}"
                        @else
                            "{{App\Models\Produtor\UsuarioTaxa::$taxaFixaPadrao}}"
                        @endif
                    step="0.50">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <hr> <label for="">Taxas Boleto</label>
        </div>
    </div>
    <div class="row">
         <div class="col-lg-6">
            <div class="form-group">
                <label>Taxa Plataforma (%)</label>
                <input type="number" name="taxas[taxaplataforma_boleto]"
                    class="form-control"
                    placeholder="Digite a taxa da plataforma para esse produtor"
                    value=
                        @if(array_key_exists('taxaplataforma_boleto', $taxas))
                            "{{ $taxas['taxaplataforma_boleto'] }}"
                        @else
                            "{{App\Models\Produtor\UsuarioTaxa::$taxaPlataformaPadrao}}"
                        @endif
                    step="0.01">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Taxa fixa (R$)</label>
                <input type="number" name="taxas[taxafixa_boleto]"
                    class="form-control"
                    placeholder="Digite a taxa da plataforma para esse produtor"
                    value=
                        @if(array_key_exists('taxafixa_boleto', $taxas))
                            "{{ $taxas['taxafixa_boleto'] }}"
                        @else
                            "{{App\Models\Produtor\UsuarioTaxa::$taxaFixaPadrao}}"
                        @endif
                    step="0.50">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Dias Adiantamento (D+X)</label>
                <input type="number" name="taxas[dias_adiantamento]"
                    class="form-control"
                    placeholder="Digite a quantidade de dias para uma compra poder ser sacada"
                    value=
                        @if(array_key_exists('dias_adiantamento', $taxas))
                            "{{ $taxas['dias_adiantamento'] }}"
                        @else
                            "{{App\Models\Produtor\UsuarioTaxa::$DiasAdiantamentoPadrao}}"
                        @endif
                    step="1">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Taxa Conveniência Padrão</label>
                <input type="number" name="taxas[taxaconveniencia]"
                    class="form-control"
                    placeholder="Taxa de conveniência"
                    value=
                        @if(array_key_exists('taxaconveniencia', $taxas))
                            "{{ $taxas['taxaconveniencia'] }}"
                        @else
                            "{{App\Models\Produtor\UsuarioTaxa::$TaxaConvenienciaPadrao}}"
                        @endif
                    step="1"
                    min="1"
                    max="100">
            </div>
        </div>
        <div class="col-lg-12">
            <div class="mt-4">
                <label>Taxas Parcelamento:</label>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="d-flex flex-column">
                @for($i = 0; $i<12; $i++)
                    <div class="d-flex align-items-center mt-1">
                        <label class="label-parcelas" for="taxas[taxasparcelamento][{{$i}}]"> {{$i<=8? '0':''}}{{$i + 1}}º Parcela:</label>
                        <input
                            type="number" name="taxas[taxasparcelamento][{{$i}}]"
                            class="form-control w-50 mobile-full ml-2"  id="taxas[taxasparcelamento][{{$i}}]"
                            placeholder="Digite a taxa para vendas com {{$i + 1}} parcelas"
                            value="{{array_key_exists('taxasparcelamento', $taxas) ? $taxas['taxasparcelamento'][$i] : $TaxasPadrao[$i]}}"
                            step="0.00001">
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>
@stop

