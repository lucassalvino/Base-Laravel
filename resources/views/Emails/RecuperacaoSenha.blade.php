@extends('Emails.Template', [
    'exibirselopagamento' => false
])


@section('content')
    <table align="left" border="0" width="800px" cellpadding="0" cellspacing="0" 
        style="padding: 35px;">
        <tr>
            <td>
                Olá {{$nome}}!
            </td>
        </tr>
        <tr>
            <td style="padding-top: 20px;">
                Segue Link para realizar a alteração da sua senha: {{$link}}
            </td>
        </tr>
    </table>
@stop