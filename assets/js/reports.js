"use strict";

// Shared Colors Definition
const primary = "#6993FF";
const success = "#1BC5BD";
const info = "#8950FC";
const warning = "#FFA800";
const danger = "#F64E60";


var base_url = APP_URL;


// Class definition
function generateBubbleData(baseval, count, yrange) {
    var i = 0;
    var series = [];
    while (i < count) {
        var x = Math.floor(Math.random() * (750 - 1 + 1)) + 1;
        var y =
            Math.floor(Math.random() * (yrange.max - yrange.min + 1)) +
            yrange.min;
        var z = Math.floor(Math.random() * (75 - 15 + 1)) + 15;

        series.push([x, y, z]);
        baseval += 86400000;
        i++;
    }
    return series;
}

function generateData(count, yrange) {
    var i = 0;
    var series = [];
    while (i < count) {
        var x = "w" + (i + 1).toString();
        var y =
            Math.floor(Math.random() * (yrange.max - yrange.min + 1)) +
            yrange.min;

        series.push({
            x: x,
            y: y,
        });
        i++;
    }
    return series;
}
var chart_11;
var chart_12;
var demopositiveChart;
var chart_positive_month;
var _demo11;
var _demo12;
var _demopositive;
var _demopositive_month;

var KTApexChartsDemo = (function() {
    // Private functions
    var _demo3 = function() {
        const apexChart = "#chart_3";

        var chart_url = base_url + "admin/charts_data";

        var data1 = [];
        var data2 = [];
        var data3 = [];
        var data4 = [];

        $.ajax({
            type: "get",
            url: chart_url,
            success: function(data) {
                var list = JSON.parse(data);

                data1.push(list[0].jan_count);
                data1.push(list[0].fep_count);
                data1.push(list[0].mar_count);
                data1.push(list[0].apr_count);
                data1.push(list[0].may_count);
                data1.push(list[0].june_count);

                data2.push(list[1].jan_count);
                data2.push(list[1].fep_count);
                data2.push(list[1].mar_count);
                data2.push(list[1].apr_count);
                data2.push(list[1].may_count);
                data2.push(list[1].june_count);

                data3.push(list[2].jan_count);
                data3.push(list[2].fep_count);
                data3.push(list[2].mar_count);
                data3.push(list[2].apr_count);
                data3.push(list[2].may_count);
                data3.push(list[2].june_count);

                data4.push(list[3].jan_count);
                data4.push(list[3].fep_count);
                data4.push(list[3].mar_count);
                data4.push(list[3].apr_count);
                data4.push(list[3].may_count);
                data4.push(list[3].june_count);

                var name1 = list[0].name;
                var name2 = list[1].name;
                var name3 = list[2].name;
                var name4 = list[3].name;

                var color1 = list[0].color;
                var color2 = list[1].color;
                var color3 = list[2].color;
                var color4 = list[3].color;


                console.log(data1);
                console.log(data2);
                console.log(data3);
                console.log(data4);

                var options = {
                    series: [{
                            name: name1,
                            data: data1,
                        },
                        {
                            name: name2,
                            data: data2,
                        },
                        {
                            name: name3,
                            data: data3,
                        },
                        {
                            name: name4,
                            data: data4,
                        },
                    ],
                    chart: {
                        type: "bar",
                        height: 350,
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: "55%",
                            endingShape: "rounded",
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ["transparent"],
                    },
                    xaxis: {
                        categories: [
                            "Feb",
                            "Mar",
                            "Apr",
                            "May",
                            "prevoius month",
                            "this month",
                        ],
                    },
                    yaxis: {
                        title: {
                            text: "(posts)",
                        },
                    },
                    fill: {
                        opacity: 1,
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return val + " posts";
                            },
                        },
                    },
                    colors: [color1, color2, color3, color4],
                };

                var chart = new ApexCharts(document.querySelector(apexChart), options);
                chart.render();

            }
        });



    };
    _demo11 = function() {
        //this week sources
        const apexChart = "#chart_11";

        var chart_url = base_url + "admin/reports_charts_data_this_week_source";

        var series = [];
        var labels = [];
        var colors = [];

        $.ajax({
            type: "get",
            url: chart_url,
            success: function(data) {

                var list = JSON.parse(data);

                for (var row in list) {
                    series.push(list[row].post_count);
                    labels.push(list[row].name);
                    colors.push(list[row].color);
                }

                var options = {
                    series: series,
                    chart: {
                        width: 380,
                        type: "donut",
                    },
                    labels: labels,
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200,
                            },
                            legend: {
                                position: "bottom",
                            },
                        },
                    }, ],
                    colors: colors,
                };

                chart_11 = new ApexCharts(document.querySelector(apexChart), options);
                chart_11.render();
            }
        });
    };

    _demo12 = function() {
        const apexChart = "#chart_12";
        var chart_url = base_url + "admin/reports_charts_data_this_month_source";

        var series = [];
        var labels = [];
        var colors = [];

        $.ajax({
            type: "get",
            url: chart_url,
            success: function(data) {
                var list = JSON.parse(data);

                for (var row in list) {
                    series.push(list[row].post_count);
                    labels.push(list[row].name);
                    colors.push(list[row].color);
                }

                var options = {
                    series: series,
                    chart: {
                        width: 380,
                        type: "pie",
                    },
                    labels: labels,
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200,
                            },
                            legend: {
                                position: "bottom",
                            },
                        },
                    }, ],
                    colors: colors,
                };

                chart_12 = new ApexCharts(document.querySelector(apexChart), options);
                chart_12.render();
            }
        });
    };

    _demopositive = function() {
        const apexChart = "#chart_positive";
        var chart_url = base_url + "admin/reports_charts_data_this_week_status";

        var positive_count = 0;
        var negative_count = 0;
        var na_count = 0;

        $.ajax({
            type: "get",
            url: chart_url,
            success: function(data) {
                var list = JSON.parse(data);

                for (var row in list) {
                    positive_count += list[row].positive_count;
                    negative_count += list[row].negative_count;
                    na_count += list[row].na_count;

                }

                var options = {
                    series: [positive_count, negative_count, na_count],
                    chart: {
                        width: 380,
                        type: "donut",
                    },
                    labels: ["positive", "negative", "N/A"],
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200,
                            },
                            legend: {
                                position: "bottom",
                            },
                        },
                    }, ],
                    colors: [success, danger, warning],
                };

                demopositiveChart = new ApexCharts(document.querySelector(apexChart), options);
                demopositiveChart.render();
            }
        });
    };

    _demopositive_month = function() {
        const apexChart = "#chart_positive_month";
        var chart_url = base_url + "admin/reports_charts_data_this_month_status";

        var positive_count = 0;
        var negative_count = 0;
        var na_count = 0;

        $.ajax({
            type: "get",
            url: chart_url,
            success: function(data) {
                var list = JSON.parse(data);

                for (var row in list) {
                    positive_count += list[row].positive_count;
                    negative_count += list[row].negative_count;
                    na_count += list[row].na_count;

                }

                var options = {
                    series: [positive_count, negative_count, na_count],
                    chart: {
                        width: 380,
                        type: "donut",
                    },
                    labels: ["positive", "negative", "N/A"],
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200,
                            },
                            legend: {
                                position: "bottom",
                            },
                        },
                    }, ],
                    colors: [success, danger, warning],
                };

                chart_positive_month = new ApexCharts(document.querySelector(apexChart), options);
                chart_positive_month.render();
            }
        });
    };

    return {
        // public functions
        init: function() {

            _demo3();
            _demo11();
            _demo12();
            _demopositive();
            _demopositive_month();
        },
    };
})();

$('#status_select').on('change', function() {
    var value = $(this).val();
    var chart_url = base_url + "admin/reports_charts_data_source_by_status";

    var weekSeries = [];
    var weekLabels = [];
    var weekColors = [];

    var monthSeries = [];
    var monthLabels = [];
    var monthColors = [];

    //alert(value);
    $.ajax({
        type: 'get',
        url: chart_url,
        data: {
            'value': value
        },
        success: function(data) {

            fillStatus_table(data, $('#status_select option:selected').text() +' posts from '+$('#posts_start_date').val()+' to '+ $('#posts_end_date').val());

            var reponse = JSON.parse(data)
            var weeklist = reponse.week;
            var monthlist = reponse.month;

            for (var row in weeklist) {
                weekSeries.push(weeklist[row].status_post_count);
                weekLabels.push(weeklist[row].name);
                weekColors.push(weeklist[row].color);
            }

            for (var row in monthlist) {
                monthSeries.push(monthlist[row].status_post_count);
                monthLabels.push(monthlist[row].name);
                monthColors.push(monthlist[row].color);
            }

            console.log(reponse);

            chart_11.updateOptions({
                series: weekSeries,
                labels: weekLabels,
                colors: weekColors,
            });

            chart_12.updateOptions({
                series: monthSeries,
                labels: monthLabels,
                colors: monthColors,
            });

        }
    });
});
$('#source_select').on('change', function() {
    var value = $(this).val();
    var chart_url = base_url + "admin/reports_charts_data_status_by_source";

    var week_positive_count = 0;
    var week_negative_count = 0;
    var week_na_count = 0;

    var month_positive_count = 0;
    var month_negative_count = 0;
    var month_na_count = 0;

    //alert(value);
    $.ajax({
        type: 'get',
        url: chart_url,
        data: {
            'value': value
        },
        success: function(data) {

            fillStatus_table(data, $('#source_select option:selected').text() +' posts from '+$('#posts_start_date').val()+' to '+ $('#posts_end_date').val());

            var reponse = JSON.parse(data)
            var weeklist = reponse.week;
            var monthlist = reponse.month;

            for (var row in weeklist) {

                week_positive_count += weeklist[row].positive_count;
                week_negative_count += weeklist[row].negative_count;
                week_na_count += weeklist[row].na_count;

            }

            for (var row in monthlist) {
                month_positive_count += monthlist[row].positive_count;
                month_negative_count += monthlist[row].negative_count;
                month_na_count += monthlist[row].na_count;
            }

            demopositiveChart.updateOptions({
                series: [week_positive_count, week_negative_count, week_na_count],
                labels: ["positive", "negative", "N/A"],
                colors: [success, danger, warning],
            });

            chart_positive_month.updateOptions({
                series: [month_positive_count, month_negative_count, month_na_count],
                labels: ["positive", "negative", "N/A"],
                colors: [success, danger, warning],
            });

        }
    });
});
$('#searsh_posts_date').on('click', function() {
    var chart_url = base_url + "admin/reports_charts_data_source_by_status_and_date";
    var series = [];
    var labels = [];
    var colors = [];
    $.ajax({
        type: 'get',
        url: chart_url,
        data: {
            'status': $('#status_select').val(),
            'posts_start_date': $('#posts_start_date').val(),
            'posts_end_date': $('#posts_end_date').val(),
            '_token': '{{ csrf_token() }}'
        },
        success: function(data) {
            fillStatus_table(data, $('#status_select option:selected').text() +' posts from '+$('#posts_start_date').val()+' to '+ $('#posts_end_date').val());




            var list = JSON.parse(data);

            console.log(list);
            for (var row in list) {
                series.push(list[row].status_post_count);
                labels.push(list[row].name);
                colors.push(list[row].color);
            }

            chart_11.updateOptions({
                series: series,
                labels: labels,
                colors: colors,
            });

            chart_12.updateOptions({
                series: series,
                labels: labels,
                colors: colors,
            });

            console.log(series);
            console.log(labels);
            console.log(colors);
        }
    });
});
$('#searsh_status_date').on('click', function() {
    var chart_url = base_url + "admin/reports_charts_data_status_by_source_and_date";
    var positive_count = 0;
    var negative_count = 0;
    var na_count = 0;

    $.ajax({
        type: 'get',
        url: chart_url,
        data: {
            'source_id': $('#source_select').val(),
            'status_start_date': $('#status_start_date').val(),
            'status_end_date': $('#status_end_date').val(),
            '_token': '{{ csrf_token() }}'
        },
        success: function(data) {
            fillSources_table(data, $('#source_select option:selected').text() +' posts from '+$('#status_start_date').val()+' to '+ $('#status_end_date').val());

            var list = JSON.parse(data);

            console.log(list);
            for (var row in list) {
                positive_count += list[row].positive_count;
                negative_count += list[row].negative_count;
                na_count += list[row].na_count;
            }

            demopositiveChart.updateOptions({
                series: [positive_count, negative_count, na_count],
                labels: ["positive", "negative", "N/A"],
                colors: [success, danger, warning],
            });

            chart_positive_month.updateOptions({
                series: [positive_count, negative_count, na_count],
                labels: ["positive", "negative", "N/A"],
                colors: [success, danger, warning],
            });


        }
    });
});


$('#show_table').on('click', function(){
$('#sources_modal').modal('show');
});

function fillSources_table(data, decribtion){
    var rows = '';
    var tbody = $('#source_tbody');
   $('#sources_modal_label').html(decribtion);
   $('.status_count').show();


    var list = JSON.parse(data);

    for (var row in list) {
        rows +='<tr>'+
        '<td>'+ list[row].name +'</td>'+
        '<td>'+ list[row].post_count +'</td>'+
        '<td>'+ list[row].positive_count +'</td>'+
        '<td>'+ list[row].negative_count +'</td>'+
        '<td>'+ list[row].na_count +'</td>'+
        '</tr>';
    }
    tbody.html(rows);
}

function fillStatus_table(data, decribtion){
    var rows = '';
    var tbody = $('#source_tbody');
   $('#sources_modal_label').html(decribtion);


   $('.status_count').hide();

    var list = JSON.parse(data);

    for (var row in list) {
        rows +='<tr>'+
        '<td>'+ list[row].name +'</td>'+
        '<td>'+ list[row].status_post_count +'</td>'+
        '</tr>';
    }
    tbody.html(rows);
}


jQuery(document).ready(function() {
    KTApexChartsDemo.init();
});


var getCanvas; //global variable

$(document).ready(function () {

    $("#print_btn").on('click', function () {
        html2canvas(document.getElementById("sources_modal_body")).then(function (canvas) {
            var anchorTag = document.createElement("a");
             document.body.appendChild(anchorTag);
             anchorTag.download = "filename.jpg";
             anchorTag.href = canvas.toDataURL();
             anchorTag.target = '_blank';
             anchorTag.click();
         });
    });
});
