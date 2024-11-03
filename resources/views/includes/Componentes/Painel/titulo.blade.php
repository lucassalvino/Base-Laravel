<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">{{$titulo}}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item">
                        <a href="{{route('painel:home.painel')}}">Home</a>
                    </li>
                    @foreach ($migalhas as $item)
                        <li class="breadcrumb-item">
                            <a href="{{$item['url']}}">{{$item['name']}}</a>
                        </li>
                    @endforeach
                    <li class="breadcrumb-item active" aria-current="page">
                        {{$titulo}}
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>