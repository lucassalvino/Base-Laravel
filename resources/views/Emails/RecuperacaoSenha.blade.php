@extends('Emails.Template',[])


@section('content')
<tr>
    <td>
        Olá {{$nome}}!
    </td>
</tr>
<tr>
    <td style="padding-top: 20px;">
        Segue Link para realizar a alteração da sua senha: {{$link_alterar_senha}}
    </td>
</tr>
@stop