@extends('home.layout.store')
@section('content')

<style>
    .card {
        background-color: #fff;
        border-radius: 10px;
        border: none;
        position: relative;
        margin-bottom: 30px;
        box-shadow: 0 0.46875rem 2.1875rem rgba(90, 97, 105, 0.1), 0 0.9375rem 1.40625rem rgba(90, 97, 105, 0.1), 0 0.25rem 0.53125rem rgba(90, 97, 105, 0.12), 0 0.125rem 0.1875rem rgba(90, 97, 105, 0.1);
    }

    .l-bg-cherry {
        background: linear-gradient(to right, #493240, #f09) !important;
        color: #fff;
    }

    .l-bg-blue-dark {
        background: linear-gradient(to right, #373b44, #4286f4) !important;
        color: #fff;
    }

    .l-bg-green-dark {
        background: linear-gradient(to right, #0a504a, #38ef7d) !important;
        color: #fff;
    }

    .l-bg-orange-dark {
        background: linear-gradient(to right, #a86008, #ffba56) !important;
        color: #fff;
    }

    .card .card-statistic-3 .card-icon-large .fas,
    .card .card-statistic-3 .card-icon-large .far,
    .card .card-statistic-3 .card-icon-large .fab,
    .card .card-statistic-3 .card-icon-large .fal {
        font-size: 110px;
    }

    .card .card-statistic-3 .card-icon {
        text-align: center;
        line-height: 50px;
        margin-left: 15px;
        color: #000;
        position: absolute;
        right: -5px;
        top: 20px;
        opacity: 0.1;
    }

    .l-bg-cyan {
        background: linear-gradient(135deg, #289cf5, #84c0ec) !important;
        color: #fff;
    }

    .l-bg-green {
        background: linear-gradient(135deg, #23bdb8 0%, #43e794 100%) !important;
        color: #fff;
    }

    .l-bg-orange {
        background: linear-gradient(to right, #f9900e, #ffba56) !important;
        color: #fff;
    }

    .l-bg-cyan {
        background: linear-gradient(135deg, #289cf5, #84c0ec) !important;
        color: #fff;
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />

<div>
    <div style="display: grid;grid-template-columns: repeat(4,1fr);gap:10px; padding-left:10px;padding-right:20px">
        <div>
            <div class="card l-bg-cherry" style="overflow: hidden;">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large"><i class="fas fa-shopping-cart"></i></div>
                    <div class="mb-4">
                        <h5 class="card-title mb-0">Orders today</h5>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8 mb-2">
                            <h2 class="d-flex align-items-center mb-0">
                                {{number_format($order_today)}}
                            </h2>
                        </div>
                        <div class="col-4 text-right">
                            <span><i class="fas fa-shopping-cart"></i></span>
                        </div>
                    </div>
                    <div class="progress mt-1 " data-height="8" style="height: 8px;">
                        <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="card l-bg-green-dark" style="overflow: hidden;">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large"><i class="fas fa-ticket-alt"></i></div>
                    <div class="mb-4">
                        <h5 class="card-title mb-0">All Products</h5>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8 mb-2">
                            <h2 class="d-flex align-items-center mb-0">
                                {{number_format($product)}}
                            </h2>
                        </div>
                        <div class="col-4 text-right">
                            <span><i class="fas fa-ticket-alt"></i></span>
                        </div>
                    </div>
                    <div class="progress mt-1 " data-height="8" style="height: 8px;">
                        <div class="progress-bar l-bg-orange" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                    </div>
                </div>
            </div>
        </div>


        <div>
            <div class="card l-bg-orange-dark" style="overflow: hidden;">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large"><i class="fas fa-dollar-sign"></i></div>
                    <div class="mb-4">
                        <h5 class="card-title mb-0">Revenue Today</h5>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8 mb-2">
                            <h2 class="d-flex align-items-center mb-0">
                                {{$revenue_today->total_price == null ? '0' : number_format(($revenue_today->total_price - $revenue_today->coupons_price) + ($revenue_today->ship - $revenue_today->coupon_frs_price))}}
                            </h2>
                        </div>
                        <div class="col-4 text-right">
                            <span><i class="fas fa-dollar-sign"></i></span>
                        </div>
                    </div>
                    <div class="progress mt-1 " data-height="8" style="height: 8px;">
                        <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="card l-bg-blue-dark" style="overflow: hidden;">
                <div class="card-statistic-3 p-4">
                    <div class="card-icon card-icon-large"><i class="fas fa-dollar-sign"></i></div>
                    <div class="mb-4">
                        <h5 class="card-title mb-0">All Revenue</h5>
                    </div>
                    <div class="row align-items-center mb-2 d-flex">
                        <div class="col-8 mb-2">
                            <h2 class="d-flex align-items-center mb-0">
                            {{$revenue->total_price == null ? '0' : number_format(($revenue->total_price - $revenue->coupons_price) + ($revenue->ship - $revenue->coupon_frs_price))}}
                            </h2>
                        </div>
                        <div class="col-4 text-right">
                            <span><i class="fas fa-dollar-sign"></i></span>
                        </div>
                    </div>
                    <div class="progress mt-1 " data-height="8" style="height: 8px;">
                        <div class="progress-bar l-bg-green" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    #area-chart,
    #line-chart,
    #bar-chart,
    #stacked,
    #pie-chart {
        min-height: 400px;
    }
    .morris-default-style {
        display: flex;
        margin: 20px 0;
        gap: 25px;
        justify-content: center;
    }
</style>
<div>
    <div class="text-center">
        <!-- <label class="label label-success">Area Chart</label> -->
        <div id="area-chart"></div>
    </div>
</div>

@endsection

@section('scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script>
    var data = [{
                y: '2014',
                a: 50,
                b: 90,
                c: 10
            },
            {
                y: '2015',
                a: 65,
                b: 75,
                c: 15
            },
            {
                y: '2016',
                a: 50,
                b: 50,
                c: 20
            },
            {
                y: '2017',
                a: 0,
                b: 0,
                c: 0
            },
            {
                y: '2018',
                a: 80,
                b: 65,
                c: 40
            },
            {
                y: '2019',
                a: 90,
                b: 70,
                c: 20
            },
            {
                y: '2020',
                a: 100,
                b: 75,
                c: 23
            },
            {
                y: '2021',
                a: 115,
                b: 75,
                c: 34
            },
            {
                y: '2022',
                a: 120,
                b: 80,
                c: 42
            },
            {
                y: '2023',
                a: 145,
                b: 85,
                c: 55
            },
            {
                y: '2024',
                a: 160,
                b: 95,
                c: 70
            }
        ],
        config = {
            data: data,
            xkey: 'y',
            ykeys: ['a', 'b', 'c'],
            labels: ['Doanh thu', 'Hoá đơn', 'Sản phẩm'],
            fillOpacity: 0.6,
            hideHover: 'auto',
            behaveLikeLine: true,
            resize: true,
            pointFillColors: ['#ffffff'],
            pointStrokeColors: ['black'],
            lineColors: ['gray', 'red', 'green'],
            behaveLikeLine: true
        };
    config.element = 'area-chart';
    Morris.Area(config);
    
    config.element = 'stacked';
    config.stacked = true;
    
</script>
@endsection