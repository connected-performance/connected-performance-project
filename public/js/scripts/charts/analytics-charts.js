var isRtl = $('html').attr('data-textdirection') === 'rtl';
var chartLeads = null;
var chartCloseRate = null;
var empLeadChart = null;
var prrChart = null;
function displaySalesAndCustomerChart(salesData, customersData) {
    var salesSeries = {
        name: 'Sales',
        type: 'bar',
        data: salesData.map(data => data.total_sales),
    };

    var customersSeries = {
        name: 'Customers',
        type: 'line',
        data: customersData.map(data => data.total_customers),
    };

    var salesLabels = salesData.map(data => {
        var monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        var monthName = monthNames[parseInt(data.sales_month) - 1];
        return monthName + ' ' + data.sales_year;
    });

    var customersLabels = customersData.map(data => {
        var monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        var monthName = monthNames[parseInt(data.customers_month) - 1];
        return monthName + ' ' + data.customers_year;
    });

    var optionsSales = {
        chart: {
            type: 'bar',
            height: 350,
        },
        xaxis: {
            categories: salesData.map(data => {
                var monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep',
                    'Oct', 'Nov', 'Dec'
                ];
                var monthName = monthNames[parseInt(data.sales_month) - 1];
                return monthName + ' ' + data.sales_year;
            }),
            labels: {
                formatter: function (value) {
                    var parts = value.split('-');
                    var year = parts[0];
                    var month = parts[1];

                    var monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep',
                        'Oct', 'Nov', 'Dec'
                    ];
                    var monthName = monthNames[parseInt(month) - 1];
                    if (monthName) {
                        return monthName + ' ' + year;
                    } else {
                        return year;
                    }
                }
            }
        },
        series: [salesSeries]
    };

    if (salesData && salesData.length) {
        var chart = new ApexCharts(document.querySelector("#analytics-sales-chart"), optionsSales);
        chart.render();
    } else {
        console.error('no data in chart');
    }

    var optionsCustomers = {
        chart: {
            type: 'line',
            height: 350,
        },
        xaxis: {
            categories: customersData.map(data => {
                var monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep',
                    'Oct', 'Nov', 'Dec'
                ];
                var monthName = monthNames[parseInt(data.customers_month) - 1];
                if (monthName) {
                    return monthName + ' ' + data.customers_year;
                } else {
                    return data.customers_year;
                }
            }),
        },
        series: [customersSeries]
    };

    if (customersData && customersData.length) {
        var chart = new ApexCharts(document.querySelector("#analytics-customers-chart"), optionsCustomers);
        chart.render();
    } else {
        console.error('no data in chart');
    }
}

function displayLeadsChart(leadsData) {
    var leadsSeries = {
        name: 'Generated Leads',
        type: 'bar',
        data: leadsData.map(data => data.total_leads),
    };
    var leadsLabels = [];
    var factor = $('#leads_by_factor').val();

    if (factor === 'yearly') {
        leadsLabels = leadsData.map(data => {
            return data.leads_year;
        });
    }
    if (factor === 'monthly' || factor === 'weekly') {
        leadsLabels = leadsData.map(data => {
            var monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            var monthName = monthNames[parseInt(data.leads_month) - 1];

            if (factor === 'monthly') {
                return monthName + ' ' + data.leads_year;
            } else if (factor === 'weekly') {
                var startDate = new Date(data.week_start_date);
                var endDate = new Date(data.week_end_date);

                var startDay = startDate.getDate();
                var endDay = endDate.getDate();
                var startMonth = monthNames[startDate.getMonth()];
                var endMonth = monthNames[endDate.getMonth()];

                return startDay + ' ' + startMonth + ' - ' + endDay + ' ' + endMonth;
            }
        });
    }

    var optionsLeads = {
        chart: {
            type: 'bar',
            height: 350,
        },
        xaxis: {
            categories: leadsLabels
        },
        series: [leadsSeries]
    };

    if (chartLeads === null) {
        chartLeads = new ApexCharts(document.querySelector("#analytics-leads-chart"), optionsLeads);
        chartLeads.render();
    } else {
        // Update the existing chart with new data
        chartLeads.updateSeries([leadsSeries]);
        chartLeads.updateOptions({
            xaxis: {
                categories: leadsLabels,
            },
        });
    }

}

function displayEmployeeCloseRateChart(data, chartDivId) {
    var closeRateData = data.map(data => (data.total_leads) ? ((data.customer_leads / data.total_leads) * 100) : 0);

    var series = {
        name: 'Close Rate',
        type: 'bar',
        data: closeRateData
    };

    labels = data.map(data => {
        return data.employee_email;
    });

    var options = {
        chart: {
            // type: 'bar',
            height: 350,
        },
        xaxis: {
            categories: labels
        },
        yaxis: {
            title: {
                text: 'Percentage'
            }
        },
        // tooltip: {
        //     custom: function({ series, seriesIndex, dataPointIndex, w }) {
        //         var employeeData = data[dataPointIndex];
        //         var closeRate = closeRateData[dataPointIndex];
        //         var tooltipContent = `<ul class="">
        //             <li>Employee: ${employeeData.employee_email}</li>
        //             <li>Employee Close Rate: ${closeRate.toFixed(2)}%</li>
        //             <li>Total Leads: ${employeeData.total_leads}</li>
        //             <li>Customer Leads: ${employeeData.customer_leads}</li>
        //         </ul>`;
        //         return tooltipContent;
        //     },
        // },
        series: [series]
    };

    if (chartCloseRate === null) {
        chartCloseRate = new ApexCharts(document.querySelector(chartDivId), options);
        chartCloseRate.render();
    } else {
        // Update the existing chart with new data
        chartCloseRate.updateSeries([series]);
        chartCloseRate.updateOptions({
            xaxis: {
                categories: labels,
            },
        });
    }

}

function getEmployeesCloseRate(url) {
    var formData = {};
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        success: function (response) {
            displayEmployeeCloseRateChart(response.leadsByEmployee, "#analytics-employee-close-rate-chart");
            displayEmployeeLeadCountChart(response.leadsByEmployee,"#analytics-leadsperemployee-chart")
        },
        error: function (response) {
            swal("Error", "Something is wrong", "error");
        }
    });
}

function displayEmployeeLeadCountChart(data,chartId) {

    var leadsData = data.map(data => data.customer_leads);
    var chart = $(chartId);

    var series = {
        name: 'Leads',
        type: 'bar',
        data: leadsData
    };

    labels = data.map(data => {
        return data.employee_email;
    });

    var options = {
        chart: {
            height: 350,
        },
        xaxis: {
            categories: labels
        },
        yaxis: {
            title: {
                text: 'Leads count'
            }
        },
        series: [series]
    };

    if (empLeadChart === null) {
        empLeadChart = new ApexCharts(document.querySelector(chartId), options);
        empLeadChart.render();
    } else {
        // Update the existing chart with new data
        empLeadChart.updateSeries([series]);
        empLeadChart.updateOptions({
            xaxis: {
                categories: labels,
            },
        });
    }

}

function getEmployeeMonthlyRecurringRevenue(url) {
    var formData = {};
    $.ajax({
        url: url,
        method: "POST",
        data: formData,
        success: function (response) {

            var revenueValues = response.employeeMonthlyRecurringRevenue.map((data) => data.invoices_total);
            var seriesName = 'Recurring revenue';

            // Call the function to add the new line series to your existing chart
            addRecurringRevenueToChart('#analytics-empMonRecRev-chart', revenueValues, seriesName);
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
        error: function (response) {
            swal("Error", "Something is wrong", "error");
        }
    });
}



function addRecurringRevenueToChart(existingChart, newDataSeries, seriesName) {
    var newSeries = {
        name: seriesName,
        type: 'bar',
        data: newDataSeries,
    };

    var options = {
        chart: {
            // type: 'bar',
            height: 350,
        },
        xaxis: {
            categories: labels
        },
        yaxis: {
            title: {
                text: 'Percentage'
            }
        },
        series: [newSeries]
    };

    if (!existingChart?.innerHTML) {
        existingChart = new ApexCharts(document.querySelector(existingChart), options);
        existingChart.render();
    } else {
        var seriesOne = {
            name: 'Close Rate',
            type: 'bar',
            data: existingChart.w.globals.series[0]
        };
        existingChart.updateSeries([seriesOne, newSeries]);

    }
}

function displayProjectedRecurringRevenueChart(data,chartId) {

    var leadsData = data;

    var series = {
        name: 'Projected recurring revenue',
        type: 'line',
        data: leadsData
    };

    labels = [
        'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
    ]

    var options = {
        chart: {
            height: 350,
        },
        xaxis: {
            categories: labels
        },
        series: [series]
    };

    if (prrChart === null) {
        prrChart = new ApexCharts(document.querySelector(chartId), options);
        prrChart.render();
    } else {
        // Update the existing chart with new data
        prrChart.updateSeries([series]);
        prrChart.updateOptions({
            xaxis: {
                categories: labels,
            },
        });
    }

}

