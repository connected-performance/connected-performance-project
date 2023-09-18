@extends('layouts/contentLayoutMaster')

@section('title', 'Analytics Dashboard')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">

        </div>
    </div>

    <!-- apex charts section start -->
    <section id="apexchart">
        <div class="row">

            <div class="col-12 col-lg-12 col-md-12">
                <div class="card">
                    <div
                        class=" card-header d-flex flex-md-row flex-column justify-content-md-between justify-content-start align-items-md-center align-items-start">
                        <h4 class="card-title">Sales</h4>
                        <div class="d-flex align-items-center mt-md-0 mt-1">

                            {{-- <input type="text" class="form-control flat-picker bg-transparent border-0 shadow-none"
                                placeholder="YYYY-MM-DD" /> <input type="mounth" class="form-control" /> --}}
                        </div>
                        <div class="d-flex align-items-center flex-wrap mt-sm-0 mt-1">
                            <h5 class="fw-bolder mb-0 me-1 t_customer"></h5>

                        </div>
                    </div>
                    <div class="card-body">
                        <div id="analytics-sales-chart"></div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4 col-md-4">
                <div class="card">
                    <div
                        class=" card-header d-flex flex-md-row flex-column justify-content-md-between justify-content-start align-items-md-center align-items-start">
                        <h4 class="card-title">Customers</h4>
                        <div class="d-flex align-items-center mt-md-0 mt-1">

                            {{-- <input type="text" class="form-control flat-picker bg-transparent border-0 shadow-none"
                                placeholder="YYYY-MM-DD" /> <input type="mounth" class="form-control" /> --}}
                        </div>
                        <div class="d-flex align-items-center flex-wrap mt-sm-0 mt-1">
                            <h5 class="fw-bolder mb-0 me-1 t_customer"></h5>

                        </div>
                    </div>
                    <div class="card-body">
                        <div id="analytics-customers-chart"></div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-8 col-md-8">
                <div class="card">
                    <div
                        class=" card-header d-flex flex-md-row flex-column justify-content-md-between justify-content-start align-items-md-center align-items-start">
                        <h4 class="card-title">Overall Leads</h4>
                        {{-- <div class="d-flex align-items-center mt-md-0 mt-1"></div> --}}
                        <div class="d-flex align-items-center flex-wrap mt-sm-0 mt-1">
                            <form action="{{ route('panel.analytics.leads-data') }}" method="POST"
                                id="leads-chart-filter-form">
                                {{-- <input type="mounth" class="form-control" /> --}}

                                <select name="by_factor" id="leads_by_factor" onchange="$(this).parent().submit()">
                                    <option value="yearly">Yearly</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="weekly">Weekly</option>
                                </select>
                            </form>

                        </div>
                    </div>
                    <div class="card-body">
                        <div id="chart-container">
                            <div id="analytics-leads-chart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-12 col-md-12">
                <div class="card">
                    <div
                        class=" card-header d-flex flex-md-row flex-column justify-content-md-between justify-content-start align-items-md-center align-items-start">
                        <h4 class="card-title">Employees Close Rate</h4>
                        <div class="d-flex align-items-center flex-wrap mt-sm-0 mt-1"></div>
                    </div>
                    <div class="card-body">
                        <div id="chart-container">
                            <div id="analytics-employee-close-rate-chart"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection

@section('page-script')
    <!-- Page js files -->

    <script src="{{ asset(mix('js/scripts/extensions/ext-component-toastr.js')) }}"></script>

    <script src="{{ asset(mix('js/scripts/charts/chart-apex.js')) }}"></script>
    <script src="{{ asset('js/scripts/charts/custom-chart.js') }}"></script>
    <script src="{{ asset('js/scripts/charts/analytics-charts.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var isRtl = $('html').attr('data-textdirection') === 'rtl';
        const salesData = {!! $salesData !!};
        const customersData = {!! $customersData !!};
        const leadsData = {!! $leadsData !!}
        displaySalesAndCustomerChart(salesData, customersData);
        displayLeadsChart(leadsData);

        $('#leads-chart-filter-form').on('submit', function(event) {
            event.preventDefault();
            var formData = {
                by_factor: $('#leads_by_factor').val()
            }

            $.ajax({
                url: "{{ route('panel.analytics.leads-data') }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    displayLeadsChart(response.leadsData);
                    if (response.status == "success") {
                        toastr[response.status](
                            response.message, 'Success', {
                                closeButton: true,
                                tapToDismiss: false,
                                progressBar: true,
                                rtl: isRtl
                            });
                    } else {
                        toastr[response.status](
                            response.message, '!Oops', {
                                closeButton: true,
                                tapToDismiss: false,
                                progressBar: true,
                                rtl: isRtl
                            });
                    }
                },
                error: function(response) {
                    swal("Error", "Something is wrong", "error");
                }
            });
        })

        getEmployeesCloseRate('{{ route('panel.analytics.get-employee-close-rate') }}');

        getEmployeeMonthlyRecurringRevenue("{{ route('panel.analytics.employee-monthly-recurring-revenue') }}");
    </script>


    {{-- <script>
        // Sample data (replace with your data)
        const LeadData = {!! $customersData !!};
        var leadsSeries = {
            name: 'Generated Leads',
            type: 'bar',
            data: LeadData.map(data => data.total_leads),
        };

        // LeadData.forEach(item => {
        //     item.date = new Date(item.date);
        // });
        var leadsLabels = LeadData.map(data => {
            var monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            var monthName = monthNames[parseInt(data.leads_month) - 1];
            return monthName + ' ' + data.leads_year;
        });

        // Initialize the chart with year data (default)
        let leadChartOptions = getChartOptions(LeadData, 'month');

        const leadChart = new ApexCharts(document.querySelector("#leads-chart"), leadChartOptions);
        leadChart.render();

        // Toggle between data views
        document.getElementById('year-btn').addEventListener('click', () => {
            leadChart.updateOptions(getChartOptions(LeadData, 'year'));
        });

        document.getElementById('month-btn').addEventListener('click', () => {
            leadChart.updateOptions(getChartOptions(LeadData, 'month'));
        });

        document.getElementById('week-btn').addEventListener('click', () => {
            leadChart.updateOptions(getChartOptions(LeadData, 'week'));
        });

        function getChartOptions(data, view) {
            let categories = [];
            let seriesData = [];

            if (view === 'year') {
                // Group data by year and calculate total value for each year
                const groupedData = groupDataByYear(data);
                categories = Object.keys(groupedData);
                seriesData = categories.map(year => {
                    return groupedData[year].reduce((sum, item) => sum + item.value, 0);
                });
            } else if (view === 'month') {
                // Group data by month and calculate total value for each month
                const groupedData = groupDataByMonth(data);
                categories = Object.keys(groupedData);
                seriesData = categories.map(month => {
                    return groupedData[month].reduce((sum, item) => sum + item.value, 0);
                });
            } else if (view === 'week') {
                // Group data by week and calculate total value for each week
                const groupedData = groupDataByWeek(data);
                categories = Object.keys(groupedData);
                seriesData = categories.map(week => {
                    return groupedData[week].reduce((sum, item) => sum + item.value, 0);
                });
            }

            return {
                chart: {
                    type: 'line',
                    height: 350,
                },
                xaxis: {
                    categories,
                },
                series: [{
                    name: 'Leads',
                    data: seriesData,
                }],
            };
        }

        // Helper function to group data by year
        function groupDataByYear(data) {
            return data.reduce((result, item) => {
                const year = item.date.getFullYear();
                if (!result[year]) {
                    result[year] = [];
                }
                result[year].push(item);
                return result;
            }, {});
        }

        // Helper function to group data by month
        function groupDataByMonth(data) {
            return data.reduce((result, item) => {
                const year = item.date.getFullYear();
                const month = item.date.getMonth() + 1; // Months are 0-indexed
                const key = `${year}-${month}`;
                if (!result[key]) {
                    result[key] = [];
                }
                result[key].push(item);
                return result;
            }, {});
        }

        // Helper function to group data by week
        function groupDataByWeek(data) {
            return data.reduce((result, item) => {
                const year = item.date.getFullYear();
                const week = getWeekNumber(item.date);
                const key = `${year}-W${week}`;
                if (!result[key]) {
                    result[key] = [];
                }
                result[key].push(item);
                return result;
            }, {});
        }

        // Helper function to get ISO week number
        function getWeekNumber(date) {
            const d = new Date(Date.UTC(date.getFullYear(), date.getMonth(), date.getDate()));
            const dayNum = d.getUTCDay() || 7;
            d.setUTCDate(d.getUTCDate() + 4 - dayNum);
            const yearStart = new Date(Date.UTC(d.getUTCFullYear(), 0, 1));
            return Math.ceil((((d - yearStart) / 86400000) + 1) / 7);
        }
    </script> --}}
@endsection
