@extends('layouts/contentLayoutMaster')
@section('title', 'Dashboard Analytics')
@section('vendor-style')
    <!-- vendor css files -->
    <!-- <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}"> -->
@endsection
@section('page-style')
    <!-- Page css files -->
    <!-- <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-invoice-list.css')) }}"> -->
@endsection
@section('content')
    <!-- Dashboard Analytics Start -->
    <section id="dashboard-analytics">
        <div class="row match-height">
            <!-- BEGIN GRAPH 1 -->
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row pb-50">
                            <div id="container1"></div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-success" onclick="show_modal_1()">Filters</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END GRAPH 1 -->
            <!-- BEGIN GRAPH 2 -->
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row pb-50">
                            <div id="container2"></div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-success" onclick="show_modal_2()">Filters</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END GRAPH 2 -->
            <!-- BEGIN GRAPH 3 -->
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row pb-50">
                            <div id="container3"></div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-success" onclick="show_modal_3()">Filters</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END GRAPH 3 -->
            <!-- BEGIN GRAPH 4 -->
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row pb-50">
                            <div id="container4"></div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-success" onclick="show_modal_4()">Filters</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END GRAPH 4 -->
             <!-- BEGIN GRAPH 5 -->
             <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row pb-50">
                            <div id="container5"></div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-success" onclick="show_modal_5()">Filters</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END GRAPH 5 -->
            <!-- BEGIN GRAPH 6 -->
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row pb-50">
                            <div id="container6"></div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-success" onclick="show_modal_6()">Filters</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END GRAPH 6 -->
            <!-- BEGIN GRAPH 7 -->
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row pb-50">
                            <div id="container7"></div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-success" onclick="show_modal_7()">Filters</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END GRAPH 7 -->
            <!-- BEGIN GRAPH 8 -->
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row pb-50">
                            <div id="container8"></div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-success" onclick="show_modal_8()">Filters</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END GRAPH 8 -->
        </div>
    </section>
    <div class="modal" id="fil_1" tabindex="-1" role="dialog">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Graph Filters</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="submit_form1" enctype='multipart/form-data' method="POST">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="graph" id="graph" value="1">
                        <div class="row mb-2">
                            <div class="col">
                                <label for="show_1">Show by</label>
                                <select class="form-control type" id="show_1" name="show_1" required>
                                    <option value="">Select Type</option>
                                    <option value="T" selected>Total Amount</option>
                                    <option value="N">Amount of Payments</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="year_1">Year</label>
                                <select class="form-control type" id="year_1" name="year_1" required>
                                    <option value="">Select Year</option>
                                    @foreach($yearlast5 as $key => $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light " data-bs-dismiss="modal">Close</button>
                        <button type="submit" type="button" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="fil_2" tabindex="-1" role="dialog">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Graph Filters</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="submit_form2" enctype='multipart/form-data' method="POST">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="graph" id="graph" value="2">
                        <div class="row mb-2">
                            <div class="col">
                                <label for="show_2">Show by</label>
                                <select class="form-control type" id="show_2" name="show_2" required>
                                    <option value="">Select Type</option>
                                    <option value="T" selected>Total Amount</option>
                                    <option value="N">Amount of Payments</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="year_2">Select Year</label>
                                <select class="form-control type" id="year_2" name="year_2" required>
                                    <option value="">Select Year</option>
                                    @foreach($yearlast5 as $key => $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light " data-bs-dismiss="modal">Close</button>
                        <button type="submit" type="button" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="fil_3" tabindex="-1" role="dialog">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Graph Filters</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="submit_form3" enctype='multipart/form-data' method="POST">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="graph" id="graph" value="3">
                        <div class="row mb-2">
                            <div class="col">
                                <label for="show_3">Show by</label>
                                <select class="form-control type" id="show_3" name="show_3" required>
                                    <option value="">Select Type</option>
                                    <option value="T" selected>Total Amount</option>
                                    <option value="N">Amount of Payments</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="year_3">Year</label>
                                <select class="form-control type" id="year_3" name="year_3" required>
                                    <option value="">Select Year</option>
                                    @foreach($yearlast5 as $key => $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light " data-bs-dismiss="modal">Close</button>
                        <button type="submit" type="button" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="fil_4" tabindex="-1" role="dialog">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Graph Filters</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="submit_form4" enctype='multipart/form-data' method="POST">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="graph" id="graph" value="4">
                        <div class="row mb-2">
                            <div class="col">
                                <label for="year_4">Year</label>
                                <select class="form-control type" id="year_4" name="year_4" required>
                                    <option value="">Select Year</option>
                                    @foreach($yearlast5 as $key => $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light " data-bs-dismiss="modal">Close</button>
                        <button type="submit" type="button" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="fil_5" tabindex="-1" role="dialog">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Graph Filters</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="submit_form5" enctype='multipart/form-data' method="POST">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="graph" id="graph" value="5">
                        <div class="row mb-2">
                            <label for="type_5">Select search type</label><br>
                            <div class="col">
                                <input type="radio" id="y_5" name="type_5" value="Y" class="type_5" checked> Year<br>
                            </div>
                            <div class="col">
                                <input type="radio" id="m_5" name="type_5" value="M" class="type_5"> Month<br>
                            </div>
                            <div class="col">
                                <input type="radio" id="w_5" name="type_5" value="W" class="type_5"> Week
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label for="year_5">Select Year</label>
                                <select class="form-control type" id="year_5" name="year_5" required>
                                    <option value="">Select Year</option>
                                    @foreach($yearlast5 as $key => $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2" style="display: none;" id="div_week_5">
                            <div class="col">
                                <label for="week_5">Select Week</label>
                                <select class="form-control type" id="week_5" name="week_5">
                                    <option value="">Select Week</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light " data-bs-dismiss="modal">Close</button>
                        <button type="submit" type="button" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="fil_6" tabindex="-1" role="dialog">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Graph Filters</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="submit_form6" enctype='multipart/form-data' method="POST">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="graph" id="graph" value="6">
                        <div class="row mb-2">
                            <div class="col">
                                <label for="year_6">Year</label>
                                <select class="form-control type" id="year_6" name="year_6" required>
                                    <option value="">Select Year</option>
                                    <option value="T" selected>Total</option>
                                    @foreach($yearlast5 as $key => $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="month_6">Month</label>
                                <select class="form-control type" id="month_6" name="month_6" required readonly>
                                    <option value="">Select Month</option>
                                    <option value="T" selected>All</option>
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">Octuber</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light " data-bs-dismiss="modal">Close</button>
                        <button type="submit" type="button" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="fil_7" tabindex="-1" role="dialog">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Graph Filters</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="submit_form7" enctype='multipart/form-data' method="POST">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="graph" id="graph" value="7">
                        <div class="row mb-2">
                            <div class="col">
                                <label for="month_7">Month</label>
                                <select class="form-control type" id="month_7" name="month_7" required>
                                    <option value="">Select Month</option>
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">Octuber</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="year_7">Year</label>
                                <select class="form-control type" id="year_7" name="year_7" required>
                                    <option value="">Select Year</option>
                                    @foreach($yearlast5 as $key => $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light " data-bs-dismiss="modal">Close</button>
                        <button type="submit" type="button" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="fil_8" tabindex="-1" role="dialog">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Graph Filters</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="submit_form8" enctype='multipart/form-data' method="POST">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="graph" id="graph" value="8">
                        <div class="row mb-2">
                            <div class="col">
                                <label for="year_8">Year</label>
                                <select class="form-control type" id="year_8" name="year_8" required>
                                    <option value="">Select Year</option>
                                    <option value="T" selected>Total</option>
                                    @foreach($yearlast5 as $key => $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="month_8">Month</label>
                                <select class="form-control type" id="month_8" name="month_8" required readonly>
                                    <option value="">Select Month</option>
                                    <option value="T" selected>All</option>
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">Octuber</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light " data-bs-dismiss="modal">Close</button>
                        <button type="submit" type="button" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Dashboard Analytics end -->
@endsection
@section('vendor-script')
    <!-- vendor files -->
    <!-- <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/moment.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script> -->
@endsection
@section('page-script')
    <!-- Page js files -->
    <!-- <script src="{{ asset(mix('js/scripts/pages/dashboard-analytics.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/pages/app-invoice-list.js')) }}"></script> -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script type="text/javascript">
        var month = <?php echo date("m") ?>;
        var year = <?php echo date("Y") ?>;
        $("#year_1").val(year);
        $("#year_2").val(year);
        $("#year_3").val(year);
        $("#year_4").val(year);
        $("#year_5").val(year);
        $("#month_7").val(month);
        $("#year_7").val(year);
        // GRAPH 1
        var dataPay = <?php echo json_encode($dataPay)?>;
        var cate_mon = <?php echo json_encode($cate_mon)?>;
        var tit_g_1 = <?php echo json_encode($tit_g_1) ?>;
        Highcharts.chart('container1', {
            chart: {
                type: 'column'
            },
            title: {
                text: tit_g_1
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: cate_mon,
                labels: {
                    rotation: 315
                }
            },
            yAxis: {
                title: {
                    text: 'Total Amount'
                }
            },
            legend: {
                layout: 'vertical'
            },
            plotOptions: {
                series: {
                    cursor: 'pointer',
                    allowPointSelect: true
                }
            },
            series: [{
                name: 'Total Amount',
                data: dataPay
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
        // GRAPH 2
        var year_act = <?php echo json_encode($year_act)?>;
        var dataPayY = <?php echo json_encode($dataPayY)?>;
        var tit_g_2 = <?php echo json_encode($tit_g_2)?>;
        Highcharts.chart('container2', {
            chart: {
                type: 'column'
            },
            title: {
                text: tit_g_2
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: year_act
            },
            yAxis: {
                title: {
                    text: 'Total Amount'
                }
            },
            legend: {
                layout: 'vertical',
                // align: 'right',
                // verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    cursor: 'pointer',
                    allowPointSelect: true
                }

            },
            series: [{
                name: 'Total Amount',
                data: dataPayY
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
        // GRAPH 3
        var dataPay1 = <?php echo json_encode($dataPay1)?>;
        var dataPro1 = <?php echo json_encode($dataPro1)?>;
        var tit_g_3 = <?php echo json_encode($tit_g_3) ?>;
        Highcharts.chart('container3', {
            chart: {
                type: 'column'
            },
            title: {
                text: tit_g_3,
            },
            subtitle: {
                text:
                    '',
            },
            xAxis: {
                categories: cate_mon,
                labels: {
                    rotation: 315
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total Amount'
                }
            },
            plotOptions: {
                series: {
                    cursor: 'pointer',
                    allowPointSelect: true
                },
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [
                {
                    name: 'Total Amount',
                    data: dataPay1
                },
                {
                    name: 'Projected',
                    data: dataPro1
                }
            ],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
        // GRAPH 4
        var dataPayRec = <?php echo json_encode($dataPayRec)?>;
        var tit_g_4 = <?php echo json_encode($tit_g_4) ?>;
        Highcharts.chart('container4', {
            chart: {
                type: 'column'
            },
            title: {
                text: tit_g_4
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: cate_mon,
                labels: {
                    rotation: 315
                }
            },
            yAxis: {
                title: {
                    text: 'Total Amount'
                }
            },
            legend: {
                layout: 'vertical'
            },
            plotOptions: {
                series: {
                    cursor: 'pointer',
                    allowPointSelect: true
                }
            },
            series: [{
                name: 'Total Amount',
                data: dataPayRec
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
        // GRAPH 5
        var dataleadtot = <?php echo json_encode($dataleadtot)?>;
        var tit_g_5 = <?php echo json_encode($tit_g_5)?>;
        Highcharts.chart('container5', {
            chart: {
                type: 'column'
            },
            title: {
                text: tit_g_5
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: year_act
            },
            yAxis: {
                title: {
                    text: 'Numbers of Leads'
                }
            },
            legend: {
                layout: 'vertical',
                //align: 'right',
                //verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    cursor: 'pointer',
                    allowPointSelect: true
                }
            },
            series: [{
                name: 'Numbers of Leads',
                data: dataleadtot
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
        // GRAPH 6
        var dataleadbyuserpor = <?php echo json_encode($dataleadbyuserpor)?>;
        var tit_g_6 = <?php echo json_encode($tit_g_6) ?>;
        var chart1 = Highcharts.chart('container6', {
            chart: {
                type: 'pie'
            },
            title: {
                text: tit_g_6
            },
            tooltip: {
                valueSuffix: '%'
            },
            subtitle: {
                text:
                ''
            },
            plotOptions: {
                series: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: [{
                        enabled: true,
                        distance: 20
                    }, {
                        enabled: true,
                        distance: -40,
                        format: '{point.percentage:.1f}%',
                        style: {
                            fontSize: '1.2em',
                            textOutline: 'none',
                            opacity: 0.7
                        },
                        filter: {
                            operator: '>',
                            property: 'percentage',
                            value: 10
                        }
                    }]
                }
            },
            series: [
                {
                    name: 'Percentage',
                    colorByPoint: true,
                    data: []
                }
            ]
        });
        for (var i = 0; i < dataleadbyuserpor.length; i++) {
            chart1.series[0].addPoint({
                name: dataleadbyuserpor[i]['name'],
                y: dataleadbyuserpor[i]['y']
            });
        }
        // GRAPH 7
        var cate_emp = <?php echo json_encode($cate_emp) ?>;
        var data_empren = <?php echo json_encode($data_empren) ?>;
        var tit_g_7 = <?php echo json_encode($tit_g_7) ?>;
        Highcharts.chart('container7', {
            chart: {
                type: 'column'
            },
            title: {
                text: tit_g_7
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: cate_emp
            },
            yAxis: {
                title: {
                    text: 'Total Amount'
                }
            },
            legend: {
                layout: 'vertical',
                //align: 'right',
                //verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    cursor: 'pointer',
                    allowPointSelect: true
                }
            },
            series: [{
                name: 'Total Amount',
                data: data_empren
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
        // GRAPH 8
        var cate_user = <?php echo json_encode($cate_user)?>;
        var data_user = <?php echo json_encode($data_user)?>;
        var tit_g_8 = <?php echo json_encode($tit_g_8) ?>;
        Highcharts.chart('container8', {
            chart: {
                type: 'column'
            },
            title: {
                text: tit_g_8
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: cate_user
            },
            yAxis: {
                title: {
                    text: 'Total Leads'
                }
            },
            legend: {
                layout: 'vertical',
                //align: 'right',
                //verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    cursor: 'pointer',
                    allowPointSelect: true
                }
            },
            series: [{
                name: 'Leads',
                data: data_user
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });

        function show_modal_1() {
            $("#fil_1").modal("show");
        }
        function show_modal_2() {
            $("#fil_2").modal("show");
        }
        function show_modal_3() {
            $("#fil_3").modal("show");
        }
        function show_modal_4() {
            $("#fil_4").modal("show");
        }
        function show_modal_5() {
            $("#fil_5").modal("show");
        }
        function show_modal_6() {
            $("#fil_6").modal("show");
        }
        function show_modal_7() {
            $("#fil_7").modal("show");
        }
        function show_modal_8() {
            $("#fil_8").modal("show");
        }

        $('#year_5').change(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var year_5 = $("#year_5").val();
            $.ajax({
                url: "{{ route('panel.analytics.weekbyyear') }}",
                method: "POST",
                data: {
                    year_5: year_5
                },
                dataType: "json",
                success: function(response) {
                    var isRtl = $('html').attr('data-textdirection') === 'rtl';
                    if (response.status == "success") {
                        var option = response.option;
                        $("#week_5").html(option);
                    }
                },
                error: function(response) {
                    alert("Failed");
                }
            })
        });

        $('.type_5').click(function(){
            if($(this).val()=="Y"){
                $("#div_week_5").hide();
                $("#week_5").attr('required', false);
            }else if($(this).val()=="M"){
                $("#div_week_5").hide();
                $("#week_5").attr('required', false);
            }else{
                $("#week_5").attr('required', true);
                if($("#year_5").val()!=""){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var year_5 = $("#year_5").val();
                    $.ajax({
                        url: "{{ route('panel.analytics.weekbyyear') }}",
                        method: "POST",
                        data: {
                            year_5: year_5
                        },
                        dataType: "json",
                        success: function(response) {
                            var isRtl = $('html').attr('data-textdirection') === 'rtl';
                            if (response.status == "success") {
                                var option = response.option;
                                $("#week_5").html(option);
                            }
                        },
                        error: function(response) {
                            alert("Failed");
                        }
                    })
                }
                $("#div_week_5").show();
            }
        });

        $('#year_6').change(function(){
            if($('#year_6').val()=='T'){
                $('#month_6').val('T');
                $("#month_6").attr('readonly', true);
            }else{
                $("#month_6").attr('readonly', false);
            }
        });

        $('#year_8').change(function(){
            if($('#year_8').val()=='T'){
                $('#month_8').val('T');
                $("#month_8").attr('readonly', true);
            }else{
                $("#month_8").attr('readonly', false);
            }
        });

        $("#submit_form1").submit(function(event) {
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let formData = new FormData(this);
            $.ajax({
                url: "{{ route('panel.analytics.update') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var isRtl = $('html').attr('data-textdirection') === 'rtl';
                    if (response.status == "success") {
                        var dataPay = response.dataPay;
                        var cate_mon = response.cate_mon;
                        var tit_g_1 = response.tit_g_1;
                        if($("#show_1").val()=="T"){
                            var title = 'Total Amount';
                        }else{
                            var title = 'Amount of Payments';
                        }
                        $("#container1").html("");
                        Highcharts.chart('container1', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: tit_g_1
                            },
                            subtitle: {
                                text: ''
                            },
                            xAxis: {
                                categories: cate_mon,
                                labels: {
                                    rotation: 315
                                }
                            },
                            yAxis: {
                                title: {
                                    text: title
                                }
                            },
                            legend: {
                                layout: 'vertical'
                            },
                            plotOptions: {
                                series: {
                                    cursor: 'pointer',
                                    allowPointSelect: true
                                }
                            },
                            series: [{
                                name: title,
                                data: dataPay
                            }],
                            responsive: {
                                rules: [{
                                    condition: {
                                        maxWidth: 500
                                    },
                                    chartOptions: {
                                        legend: {
                                            layout: 'horizontal',
                                            align: 'center',
                                            verticalAlign: 'bottom'
                                        }
                                    }
                                }]
                            }
                        });
                        $("#fil_1").modal('hide');
                    }
                },
                error: function(response) {
                    alert("Failed")
                }
            });
        });

        $("#submit_form2").submit(function(event) {
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let formData = new FormData(this);
            $.ajax({
                url: "{{ route('panel.analytics.update') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var isRtl = $('html').attr('data-textdirection') === 'rtl';
                    if (response.status == "success") {
                        var year_act = response.year_act;
                        var dataPayY = response.dataPayY;
                        var tit_g_2 = response.tit_g_2;
                        if($("#show_2").val()=="T"){
                            var tit_det = 'Total Amount';
                        }else{
                            var tit_det = 'Amount of Payments';
                        }
                        $("#container2").html("");
                        Highcharts.chart('container2', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: tit_g_2
                            },
                            subtitle: {
                                text: ''
                            },
                            xAxis: {
                                categories: year_act
                            },
                            yAxis: {
                                title: {
                                    text: tit_det
                                }
                            },
                            legend: {
                                layout: 'vertical',
                                // align: 'right',
                                // verticalAlign: 'middle'
                            },
                            plotOptions: {
                                series: {
                                    cursor: 'pointer',
                                    allowPointSelect: true
                                }

                            },
                            series: [{
                                name: tit_det,
                                data: dataPayY
                            }],
                            responsive: {
                                rules: [{
                                    condition: {
                                        maxWidth: 500
                                    },
                                    chartOptions: {
                                        legend: {
                                            layout: 'horizontal',
                                            align: 'center',
                                            verticalAlign: 'bottom'
                                        }
                                    }
                                }]
                            }
                        });
                        $("#fil_2").modal('hide');
                    }
                },
                error: function(response) {
                    alert("Failed")
                }
            });
        });

        $("#submit_form3").submit(function(event) {
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let formData = new FormData(this);
            $.ajax({
                url: "{{ route('panel.analytics.update') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var isRtl = $('html').attr('data-textdirection') === 'rtl';
                    if (response.status == "success") {
                        var cate_mon = response.cate_mon;
                        var dataPay1 = response.dataPay1;
                        var dataPro1 = response.dataPro1;
                        var tit_g_3 = response.tit_g_3;
                        if($("#show_2").val()=="T"){
                            var title = 'Total Amount';
                        }else{
                            var title = 'Amount of Payments';
                        }
                        $("#container3").html("");
                        Highcharts.chart('container3', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: tit_g_3,
                            },
                            subtitle: {
                                text:
                                    '',
                            },
                            xAxis: {
                                categories: cate_mon,
                                labels: {
                                    rotation: 315
                                }
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: title
                                }
                            },
                            plotOptions: {
                                series: {
                                    cursor: 'pointer',
                                    allowPointSelect: true
                                },
                                column: {
                                    pointPadding: 0.2,
                                    borderWidth: 0
                                }
                            },
                            series: [
                                {
                                    name: title,
                                    data: dataPay1
                                },
                                {
                                    name: 'Projected',
                                    data: dataPro1
                                }
                            ],
                            responsive: {
                                rules: [{
                                    condition: {
                                        maxWidth: 500
                                    },
                                    chartOptions: {
                                        legend: {
                                            layout: 'horizontal',
                                            align: 'center',
                                            verticalAlign: 'bottom'
                                        }
                                    }
                                }]
                            }
                        });
                        $("#fil_3").modal('hide');
                    }
                },
                error: function(response) {
                    alert("Failed")
                }
            });
        });

        $("#submit_form4").submit(function(event) {
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let formData = new FormData(this);
            $.ajax({
                url: "{{ route('panel.analytics.update') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var isRtl = $('html').attr('data-textdirection') === 'rtl';
                    if (response.status == "success") {
                        var cate_mon = response.cate_mon;
                        var dataPayRec = response.dataPayRec;
                        var tit_g_4 = response.tit_g_4;
                        $("#container4").html("");
                        Highcharts.chart('container4', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: tit_g_4
                            },
                            subtitle: {
                                text: ''
                            },
                            xAxis: {
                                categories: cate_mon,
                                labels: {
                                    rotation: 315
                                }
                            },
                            yAxis: {
                                title: {
                                    text: 'Total Amount'
                                }
                            },
                            legend: {
                                layout: 'vertical'
                            },
                            plotOptions: {
                                series: {
                                    cursor: 'pointer',
                                    allowPointSelect: true
                                }
                            },
                            series: [{
                                name: 'Total Amount',
                                data: dataPayRec
                            }],
                            responsive: {
                                rules: [{
                                    condition: {
                                        maxWidth: 500
                                    },
                                    chartOptions: {
                                        legend: {
                                            layout: 'horizontal',
                                            align: 'center',
                                            verticalAlign: 'bottom'
                                        }
                                    }
                                }]
                            }
                        });
                        $("#fil_4").modal('hide');
                    }
                },
                error: function(response) {
                    alert("Failed")
                }
            });
        });

        $("#submit_form5").submit(function(event) {
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let formData = new FormData(this);
            $.ajax({
                url: "{{ route('panel.analytics.update') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var isRtl = $('html').attr('data-textdirection') === 'rtl';
                    if (response.status == "success") {
                        var cate = response.cate;
                        var dataleadtot = response.dataleadtot;
                        var tit_g_5 = response.tit_g_5;
                        $("#container5").html("");
                        Highcharts.chart('container5', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: tit_g_5
                            },
                            subtitle: {
                                text: ''
                            },
                            xAxis: {
                                categories: cate
                            },
                            yAxis: {
                                title: {
                                    text: 'Numbers of Leads'
                                }
                            },
                            legend: {
                                layout: 'vertical',
                                //align: 'right',
                                //verticalAlign: 'middle'
                            },
                            plotOptions: {
                                series: {
                                    cursor: 'pointer',
                                    allowPointSelect: true
                                }
                            },
                            series: [{
                                name: 'Numbers of Leads',
                                data: dataleadtot
                            }],
                            responsive: {
                                rules: [{
                                    condition: {
                                        maxWidth: 500
                                    },
                                    chartOptions: {
                                        legend: {
                                            layout: 'horizontal',
                                            align: 'center',
                                            verticalAlign: 'bottom'
                                        }
                                    }
                                }]
                            }
                        });
                        $("#fil_5").modal('hide');
                    }
                },
                error: function(response) {
                    alert("Failed")
                }
            });
        });

        $("#submit_form6").submit(function(event) {
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let formData = new FormData(this);
            $.ajax({
                url: "{{ route('panel.analytics.update') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var isRtl = $('html').attr('data-textdirection') === 'rtl';
                    if (response.status == "success") {
                        var dataleadbyuserpor = response.dataleadbyuserpor;
                        var tit_g_6 = response.tit_g_6;
                        $("#container6").html("");
                        var chart1 = Highcharts.chart('container6', {
                            chart: {
                                type: 'pie'
                            },
                            title: {
                                text: tit_g_6
                            },
                            tooltip: {
                                valueSuffix: '%'
                            },
                            subtitle: {
                                text:
                                ''
                            },
                            plotOptions: {
                                series: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    dataLabels: [{
                                        enabled: true,
                                        distance: 20
                                    }, {
                                        enabled: true,
                                        distance: -40,
                                        format: '{point.percentage:.1f}%',
                                        style: {
                                            fontSize: '1.2em',
                                            textOutline: 'none',
                                            opacity: 0.7
                                        },
                                        filter: {
                                            operator: '>',
                                            property: 'percentage',
                                            value: 10
                                        }
                                    }]
                                }
                            },
                            series: [
                                {
                                    name: 'Percentage',
                                    colorByPoint: true,
                                    data: []
                                }
                            ]
                        });
                        for (var i = 0; i < dataleadbyuserpor.length; i++) {
                            chart1.series[0].addPoint({
                                name: dataleadbyuserpor[i]['name'],
                                y: dataleadbyuserpor[i]['y']
                            });
                        }
                        $("#fil_6").modal('hide');
                    }
                },
                error: function(response) {
                    alert("Failed")
                }
            });
        });

        $("#submit_form7").submit(function(event) {
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let formData = new FormData(this);
            $.ajax({
                url: "{{ route('panel.analytics.update') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var isRtl = $('html').attr('data-textdirection') === 'rtl';
                    if (response.status == "success") {
                        var cate_emp = response.cate_emp;
                        var data_empren = response.data_empren;
                        var tit_g_7 = response.tit_g_7;
                        $("#container7").html("");
                        Highcharts.chart('container7', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: tit_g_7
                            },
                            subtitle: {
                                text: ''
                            },
                            xAxis: {
                                categories: cate_emp
                            },
                            yAxis: {
                                title: {
                                    text: 'Total Amount'
                                }
                            },
                            legend: {
                                layout: 'vertical',
                                //align: 'right',
                                //verticalAlign: 'middle'
                            },
                            plotOptions: {
                                series: {
                                    cursor: 'pointer',
                                    allowPointSelect: true
                                }
                            },
                            series: [{
                                name: 'Total Amount',
                                data: data_empren
                            }],
                            responsive: {
                                rules: [{
                                    condition: {
                                        maxWidth: 500
                                    },
                                    chartOptions: {
                                        legend: {
                                            layout: 'horizontal',
                                            align: 'center',
                                            verticalAlign: 'bottom'
                                        }
                                    }
                                }]
                            }
                        });
                        $("#fil_7").modal('hide');
                    }
                },
                error: function(response) {
                    alert("Failed")
                }
            });
        });

        $("#submit_form8").submit(function(event) {
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let formData = new FormData(this);
            $.ajax({
                url: "{{ route('panel.analytics.update') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var isRtl = $('html').attr('data-textdirection') === 'rtl';
                    if (response.status == "success") {
                        var cate_user = response.cate_user;
                        var data_user = response.data_user;
                        var tit_g_8 = response.tit_g_8;
                        $("#container8").html("");
                        Highcharts.chart('container8', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: tit_g_8
                            },
                            subtitle: {
                                text: ''
                            },
                            xAxis: {
                                categories: cate_user
                            },
                            yAxis: {
                                title: {
                                    text: 'Total Leads'
                                }
                            },
                            legend: {
                                layout: 'vertical',
                                //align: 'right',
                                //verticalAlign: 'middle'
                            },
                            plotOptions: {
                                series: {
                                    cursor: 'pointer',
                                    allowPointSelect: true
                                }
                            },
                            series: [{
                                name: 'Leads',
                                data: data_user
                            }],
                            responsive: {
                                rules: [{
                                    condition: {
                                        maxWidth: 500
                                    },
                                    chartOptions: {
                                        legend: {
                                            layout: 'horizontal',
                                            align: 'center',
                                            verticalAlign: 'bottom'
                                        }
                                    }
                                }]
                            }
                        });
                        $("#fil_8").modal('hide');
                    }
                },
                error: function(response) {
                    alert("Failed")
                }
            });
        });
    </script>
@endsection

