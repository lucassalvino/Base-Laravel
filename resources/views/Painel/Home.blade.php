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
                    @endphp
                    <div class="inner">
                        <h3>{{ $total }}</h3>
                        <p>Algum dado</p>
                    </div>
                    <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z"></path></svg>
                    <a href="#"
                        class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                        Ver Todos <i class="bi bi-link-45deg"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 connectedSortable">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Total tempo</h3>
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
                    name: "Tipo 1", //1
                    data: @json($valores[1]),
                },
                {
                    name: "Tipo 2", //8
                    data: @json($valores[8]),
                },
                {
                    name: "Tipo 3", //7
                    data: @json($valores[7]),
                },
                {
                    name: "Tipo 4", //2
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
