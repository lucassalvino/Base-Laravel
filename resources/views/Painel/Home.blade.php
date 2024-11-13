@extends('layouts.painel', [
    'titulo' => 'Dashboard',
    'menuativo' => 'menu-dashboard|menu-status',
    'menuexpand' => 'menu-dashboard',
])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-primary">
                    @php
                        $total = 0;
                        foreach ($dadosGraficos['ultimos_30_dias'] ?? [] as $dt) {
                            if (intval($dt['status'] ?? -1) == 2 || intval($dt['status'] ?? -1) == 7) {
                                $total += intval($dt['qtd'] ?? 0);
                            }
                        }
                    @endphp
                    <div class="inner">
                        <h3>{{ $total }}</h3>
                        <p>Novas vendas</p>
                    </div>
                    <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z"></path></svg>
                    <a href="#"
                        class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                        Todas cobranças <i class="bi bi-link-45deg"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-warning">
                    <div class="inner">
                        <h3>{{ $dadosGraficos['links_ultimos_30_dias'] ?? 0 }}</h3>
                        <p>Links gerados</p>
                    </div>
                    <svg class="small-box-icon" fill="#e5ad06" viewBox="0 0 72 72" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><g><g><path d="M18.321,69.07c-2.874,0-5.775-0.845-8.31-2.604l-0.534-0.371c-6.614-4.593-8.259-13.712-3.666-20.326l13.931-18.588 c2.183-3.146,5.522-5.292,9.361-5.984c3.839-0.694,7.717,0.152,10.921,2.377l0.534,0.37c2.72,1.888,4.735,4.676,5.675,7.85 c0.313,1.059-0.291,2.172-1.351,2.485c-1.058,0.311-2.171-0.29-2.485-1.351c-0.691-2.337-2.116-4.308-4.119-5.698l-0.534-0.37 c-2.328-1.617-5.146-2.231-7.931-1.727c-2.787,0.503-5.212,2.061-6.828,4.388L9.055,48.108 c-3.293,4.744-2.099,11.365,2.704,14.701l0.534,0.371c4.801,3.334,11.423,2.142,14.759-2.66l4.256-6.126 c0.631-0.905,1.875-1.129,2.784-0.501c0.906,0.631,1.131,1.877,0.501,2.784l-4.256,6.125C27.504,66.882,22.948,69.07,18.321,69.07 z" /></g><g><path d="M40.297,51.043c-2.877,0-5.784-0.844-8.323-2.606l-0.538-0.375c-2.718-1.888-4.731-4.674-5.669-7.845 c-0.313-1.06,0.292-2.172,1.351-2.485c1.063-0.313,2.173,0.291,2.485,1.351c0.69,2.335,2.114,4.305,4.117,5.696l0.538,0.375 c4.799,3.332,11.421,2.138,14.757-2.664l13.93-18.59c3.294-4.744,2.1-11.365-2.703-14.701l-0.53-0.365 c-2.332-1.621-5.147-2.232-7.936-1.731c-2.787,0.503-5.212,2.061-6.828,4.388l-4.255,6.125c-0.63,0.908-1.876,1.132-2.783,0.502 s-1.132-1.876-0.502-2.783l4.255-6.125c2.225-3.205,5.564-5.351,9.404-6.043c3.838-0.691,7.718,0.153,10.922,2.379l0.529,0.365 c6.62,4.598,8.264,13.717,3.67,20.33l-13.93,18.59C49.453,48.868,44.914,51.043,40.297,51.043z" /></g><g><path d="M52.76,33.106c-0.209,0-0.419-0.065-0.599-0.2c-0.442-0.331-0.532-0.958-0.2-1.399l0.548-0.73 c0.331-0.442,0.959-0.53,1.399-0.2c0.442,0.331,0.532,0.958,0.2,1.399l-0.548,0.73C53.364,32.969,53.064,33.106,52.76,33.106z" /></g><g><path d="M55.047,30.056c-0.209,0-0.419-0.065-0.599-0.2c-0.442-0.331-0.532-0.958-0.2-1.399l4.426-5.904 c1.061-1.528,1.471-3.414,1.134-5.28c-0.337-1.867-1.38-3.491-2.938-4.572l-0.343-0.237c-0.454-0.315-0.567-0.938-0.253-1.392 c0.313-0.454,0.936-0.568,1.392-0.253l0.344,0.238c1.997,1.387,3.334,3.468,3.766,5.86s-0.094,4.81-1.48,6.806l-4.447,5.934 C55.651,29.918,55.352,30.056,55.047,30.056z" /></g></g></svg>
                    <a href="#"
                        class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                        Ver todos os links <i class="bi bi-link-45deg"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-success">
                    <div class="inner">
                        <h3>{{ $dadosGraficos['links_pagos_ultimos_30_dias'] ?? 0 }}</h3>
                        <p>Links pagos</p>
                    </div>
                    <svg class="small-box-icon" fill="#16794b" viewBox="0 0 72 72" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><g><g><path d="M18.321,69.07c-2.874,0-5.775-0.845-8.31-2.604l-0.534-0.371c-6.614-4.593-8.259-13.712-3.666-20.326l13.931-18.588 c2.183-3.146,5.522-5.292,9.361-5.984c3.839-0.694,7.717,0.152,10.921,2.377l0.534,0.37c2.72,1.888,4.735,4.676,5.675,7.85 c0.313,1.059-0.291,2.172-1.351,2.485c-1.058,0.311-2.171-0.29-2.485-1.351c-0.691-2.337-2.116-4.308-4.119-5.698l-0.534-0.37 c-2.328-1.617-5.146-2.231-7.931-1.727c-2.787,0.503-5.212,2.061-6.828,4.388L9.055,48.108 c-3.293,4.744-2.099,11.365,2.704,14.701l0.534,0.371c4.801,3.334,11.423,2.142,14.759-2.66l4.256-6.126 c0.631-0.905,1.875-1.129,2.784-0.501c0.906,0.631,1.131,1.877,0.501,2.784l-4.256,6.125C27.504,66.882,22.948,69.07,18.321,69.07 z" /></g><g><path d="M40.297,51.043c-2.877,0-5.784-0.844-8.323-2.606l-0.538-0.375c-2.718-1.888-4.731-4.674-5.669-7.845 c-0.313-1.06,0.292-2.172,1.351-2.485c1.063-0.313,2.173,0.291,2.485,1.351c0.69,2.335,2.114,4.305,4.117,5.696l0.538,0.375 c4.799,3.332,11.421,2.138,14.757-2.664l13.93-18.59c3.294-4.744,2.1-11.365-2.703-14.701l-0.53-0.365 c-2.332-1.621-5.147-2.232-7.936-1.731c-2.787,0.503-5.212,2.061-6.828,4.388l-4.255,6.125c-0.63,0.908-1.876,1.132-2.783,0.502 s-1.132-1.876-0.502-2.783l4.255-6.125c2.225-3.205,5.564-5.351,9.404-6.043c3.838-0.691,7.718,0.153,10.922,2.379l0.529,0.365 c6.62,4.598,8.264,13.717,3.67,20.33l-13.93,18.59C49.453,48.868,44.914,51.043,40.297,51.043z" /></g><g><path d="M52.76,33.106c-0.209,0-0.419-0.065-0.599-0.2c-0.442-0.331-0.532-0.958-0.2-1.399l0.548-0.73 c0.331-0.442,0.959-0.53,1.399-0.2c0.442,0.331,0.532,0.958,0.2,1.399l-0.548,0.73C53.364,32.969,53.064,33.106,52.76,33.106z" /></g><g><path d="M55.047,30.056c-0.209,0-0.419-0.065-0.599-0.2c-0.442-0.331-0.532-0.958-0.2-1.399l4.426-5.904 c1.061-1.528,1.471-3.414,1.134-5.28c-0.337-1.867-1.38-3.491-2.938-4.572l-0.343-0.237c-0.454-0.315-0.567-0.938-0.253-1.392 c0.313-0.454,0.936-0.568,1.392-0.253l0.344,0.238c1.997,1.387,3.334,3.468,3.766,5.86s-0.094,4.81-1.48,6.806l-4.447,5.934 C55.651,29.918,55.352,30.056,55.047,30.056z" /></g></g></svg>
                    <a href="#"
                        class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                        Ver todos os links <i class="bi bi-link-45deg"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 connectedSortable">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Total de vendas</h3>
                    </div>
                    <div class="card-body">
                        <div id="revenue-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts_adicionais')
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
        const Default = {
            scrollbarTheme: "os-theme-light",
            scrollbarAutoHide: "leave",
            scrollbarClickScroll: true,
        };
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (
                sidebarWrapper &&
                typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
            ) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
        const connectedSortables =
            document.querySelectorAll(".connectedSortable");
        connectedSortables.forEach((connectedSortable) => {
            let sortable = new Sortable(connectedSortable, {
                group: "shared",
                handle: ".card-header",
            });
        });

        const cardHeaders = document.querySelectorAll(
            ".connectedSortable .card-header",
        );
        cardHeaders.forEach((cardHeader) => {
            cardHeader.style.cursor = "move";
        });
        @php
            $valores = [
                1 => [0],
                2 => [0],
                8 => [0],
                7 => [0],
            ];
            $datas = [];
        @endphp

        const sales_chart_options = {
            series: [{
                    name: "Cancelado", //1
                    data: @json($valores[1]),
                },
                {
                    name: "Falha", //8
                    data: @json($valores[8]),
                },
                {
                    name: "Pendente", //7
                    data: @json($valores[7]),
                },
                {
                    name: "Pago", //2
                    data: @json($valores[2]),
                }
            ],
            chart: {
                height: 300,
                type: "area",
                toolbar: {
                    show: false,
                },
            },
            legend: {
                show: true,
            },
            colors: ["#0d6efd", "#FF0000", "#e5ad06", "#20c997"],
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: "smooth",
            },
            yaxis: {
                labels: {
                    formatter: function (val) {
                        return (val).toFixed(0);
                    },
                },
            },
            xaxis: {
                labels: {
                    formatter: function (val) {
                        var data = new Date(val);
                        return data.getDate()  + "/" + (data.getMonth()+1) 
                    },
                },
                categories: @json(array_keys($datas)),
            },
            tooltip: {
                x: {
                    format: "dd/MM/yyyy",
                },
            },
        };

        const sales_chart = new ApexCharts(
            document.querySelector("#revenue-chart"),
            sales_chart_options,
        );
        sales_chart.render();
    </script>
@stop
