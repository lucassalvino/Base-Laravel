@extends('layouts.publico')

@section('content')
<div class="container-fluid m-4 p-4">
    <div class="row">
        @foreach($filmes as $key => $value)
            <div class="col-md-3">
                <img src="{{$value['Poster']}}" width="275" height="400" alt="">
                <h3>{{$value['Title']}}</h3>
                <p>{{$value['Year']}}</p>
                
            </div>
        @endforeach
    </div>
</div>
@stop