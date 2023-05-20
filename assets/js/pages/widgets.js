"use strict";

// Class definition
var KTWidgets = (function() {

    var chart_url = APP_URL+'/admin/charts_data';


    var _initTilesWidget2 = function() {

        var month_1 = 0;
        var month_2 = 0;
        var month_3 = 0;
        var month_4 = 0;
        var month_5 = 0;
        var month_6 = 0;

        var title = '';
        var post_count = 0;

        $.ajax({
            type: "get",
            url: chart_url,
            success: function(data) {
                var list = JSON.parse(data);

                month_1 = list[0].jan_count;
                month_2 = list[0].fep_count;
                month_3 = list[0].mar_count;
                month_4 = list[0].apr_count;
                month_5 = list[0].may_count;
                month_6 = list[0].june_count;

                var max_value = Math.max(month_1, month_2, month_3, month_4, month_5, month_6);
                title = list[0].name;
                post_count = list[0].post_count;

                document.getElementById(
                    "kt_tiles_widget_2_chart_title"
                ).innerHTML = title + " Status";
                document.getElementById(
                    "kt_tiles_widget_2_chart_count"
                ).innerHTML = post_count;

                document.getElementById(
                    "kt_tiles_widget_2_chart_div"
                ).style.backgroundColor = list[0].color;

                //take data and catogries
                var element = document.getElementById(
                    "kt_tiles_widget_2_chart"
                );
                var height = parseInt(KTUtil.css(element, "height"));

                if (!element) {
                    return;
                }

                var strokeColor = KTUtil.colorDarken(
                    KTApp.getSettings()["colors"]["theme"]["base"]["danger"],
                    20
                );
                var fillColor = KTUtil.colorDarken(
                    KTApp.getSettings()["colors"]["theme"]["base"]["danger"],
                    10
                );



                var options = {
                    series: [{
                        name: "Posts",
                        data: [
                            month_1,
                            month_2,
                            month_3,
                            month_4,
                            month_5,
                            month_6,
                        ],
                    }, ],
                    chart: {
                        type: "area",
                        height: height,
                        zoom: {
                            enabled: false,
                        },
                        sparkline: {
                            enabled: true,
                        },
                        padding: {
                            top: 0,
                            bottom: 0,
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    fill: {
                        type: "solid",
                        opacity: 1,
                    },
                    stroke: {
                        curve: "smooth",
                        show: true,
                        width: 3,
                        colors: [strokeColor],
                    },
                    xaxis: {
                        categories: ["jan", "Feb", "Mar", "Apr", "May", "June"],
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false,
                        },
                        labels: {
                            show: false,
                            style: {
                                colors: KTApp.getSettings()["colors"]["gray"][
                                    "gray-500"
                                ],
                                fontSize: "12px",
                                fontFamily: KTApp.getSettings()["font-family"],
                            },
                        },
                        crosshairs: {
                            show: false,
                            position: "front",
                            stroke: {
                                color: KTApp.getSettings()["colors"]["gray"][
                                    "gray-300"
                                ],
                                width: 1,
                                dashArray: 3,
                            },
                        },
                    },
                    yaxis: {
                        min: 0,
                        max: max_value,
                        labels: {
                            show: false,
                            style: {
                                colors: KTApp.getSettings()["colors"]["gray"][
                                    "gray-500"
                                ],
                                fontSize: "12px",
                                fontFamily: KTApp.getSettings()["font-family"],
                            },
                        },
                    },
                    states: {
                        normal: {
                            filter: {
                                type: "none",
                                value: 0,
                            },
                        },
                        hover: {
                            filter: {
                                type: "none",
                                value: 0,
                            },
                        },
                        active: {
                            allowMultipleDataPointsSelection: false,
                            filter: {
                                type: "none",
                                value: 0,
                            },
                        },
                    },
                    tooltip: {
                        style: {
                            fontSize: "12px",
                            fontFamily: KTApp.getSettings()["font-family"],
                        },
                        fixed: {
                            enabled: false,
                        },
                        x: {
                            show: false,
                        },
                        y: {
                            title: {
                                formatter: function(val) {
                                    return val + "";
                                },
                            },
                        },
                    },
                    colors: [fillColor],
                    markers: {
                        colors: [
                            KTApp.getSettings()["colors"]["theme"]["light"][
                                "danger"
                            ],
                        ],
                        strokeColor: [strokeColor],
                        strokeWidth: 3,
                    },
                };

                var chart = new ApexCharts(element, options);
                chart.render();
            },
        });
    };

    var _initTilesWidget3 = function() {


        var month_1 = 0;
        var month_2 = 0;
        var month_3 = 0;
        var month_4 = 0;
        var month_5 = 0;
        var month_6 = 0;

        var title = '';
        var post_count = 0;

        $.ajax({
            type: "get",
            url: chart_url,
            success: function(data) {
                var list = JSON.parse(data);

                month_1 = list[1].jan_count;
                month_2 = list[1].fep_count;
                month_3 = list[1].mar_count;
                month_4 = list[1].apr_count;
                month_5 = list[1].may_count;
                month_6 = list[1].june_count;

                var max_value = Math.max(month_1, month_2, month_3, month_4, month_5, month_6);
                title = list[1].name;
                post_count = list[1].post_count;





                document.getElementById(
                    "kt_tiles_widget_3_chart_title"
                ).innerHTML = title + " Status";
                document.getElementById(
                    "kt_tiles_widget_3_chart_count"
                ).innerHTML = post_count;

                document.getElementById(
                    "kt_tiles_widget_3_chart_div"
                ).style.backgroundColor = list[1].color;

                //take data and catogries
                var element = document.getElementById(
                    "kt_tiles_widget_3_chart"
                );
                var height = parseInt(KTUtil.css(element, "height"));

                if (!element) {
                    return;
                }

                var strokeColor = KTUtil.colorDarken(
                    KTApp.getSettings()["colors"]["theme"]["base"]["danger"],
                    20
                );
                var fillColor = KTUtil.colorDarken(
                    KTApp.getSettings()["colors"]["theme"]["base"]["danger"],
                    10
                );

                var options = {
                    series: [{
                        name: "Posts",
                        data: [
                            month_1,
                            month_2,
                            month_3,
                            month_4,
                            month_5,
                            month_6,
                        ],
                    }, ],
                    chart: {
                        type: "area",
                        height: height,
                        zoom: {
                            enabled: false,
                        },
                        sparkline: {
                            enabled: true,
                        },
                        padding: {
                            top: 0,
                            bottom: 0,
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    fill: {
                        type: "solid",
                        opacity: 1,
                    },
                    stroke: {
                        curve: "smooth",
                        show: true,
                        width: 3,
                        colors: [strokeColor],
                    },
                    xaxis: {
                        categories: ["jan", "Feb", "Mar", "Apr", "May", "June"],
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false,
                        },
                        labels: {
                            show: false,
                            style: {
                                colors: KTApp.getSettings()["colors"]["gray"][
                                    "gray-500"
                                ],
                                fontSize: "12px",
                                fontFamily: KTApp.getSettings()["font-family"],
                            },
                        },
                        crosshairs: {
                            show: false,
                            position: "front",
                            stroke: {
                                color: KTApp.getSettings()["colors"]["gray"][
                                    "gray-300"
                                ],
                                width: 1,
                                dashArray: 3,
                            },
                        },
                    },
                    yaxis: {
                        min: 0,
                        max: max_value,
                        labels: {
                            show: false,
                            style: {
                                colors: KTApp.getSettings()["colors"]["gray"][
                                    "gray-500"
                                ],
                                fontSize: "12px",
                                fontFamily: KTApp.getSettings()["font-family"],
                            },
                        },
                    },
                    states: {
                        normal: {
                            filter: {
                                type: "none",
                                value: 0,
                            },
                        },
                        hover: {
                            filter: {
                                type: "none",
                                value: 0,
                            },
                        },
                        active: {
                            allowMultipleDataPointsSelection: false,
                            filter: {
                                type: "none",
                                value: 0,
                            },
                        },
                    },
                    tooltip: {
                        style: {
                            fontSize: "12px",
                            fontFamily: KTApp.getSettings()["font-family"],
                        },
                        fixed: {
                            enabled: false,
                        },
                        x: {
                            show: false,
                        },
                        y: {
                            title: {
                                formatter: function(val) {
                                    return val + "";
                                },
                            },
                        },
                    },
                    colors: [fillColor],
                    markers: {
                        colors: [
                            KTApp.getSettings()["colors"]["theme"]["light"][
                                "danger"
                            ],
                        ],
                        strokeColor: [strokeColor],
                        strokeWidth: 3,
                    },
                };

                var chart = new ApexCharts(element, options);
                chart.render();
            },
        });
    };

    var _initTilesWidget4 = function() {

        var month_1 = 0;
        var month_2 = 0;
        var month_3 = 0;
        var month_4 = 0;
        var month_5 = 0;
        var month_6 = 0;

        var title = '';
        var post_count = 0;

        $.ajax({
            type: "get",
            url: chart_url,
            success: function(data) {
                var list = JSON.parse(data);

                month_1 = list[2].jan_count;
                month_2 = list[2].fep_count;
                month_3 = list[2].mar_count;
                month_4 = list[2].apr_count;
                month_5 = list[2].may_count;
                month_6 = list[2].june_count;

                var max_value = Math.max(month_1, month_2, month_3, month_4, month_5, month_6);
                title = list[2].name;
                post_count = list[2].post_count;

                document.getElementById(
                    "kt_tiles_widget_4_chart_title"
                ).innerHTML = title + " Status";
                document.getElementById(
                    "kt_tiles_widget_4_chart_count"
                ).innerHTML = post_count;

                //take data and catogries
                var element = document.getElementById(
                    "kt_tiles_widget_4_chart"
                );

                document.getElementById(
                    "kt_tiles_widget_4_chart_div"
                ).style.backgroundColor = list[2].color;


                var height = parseInt(KTUtil.css(element, "height"));

                if (!element) {
                    return;
                }

                var strokeColor = KTUtil.colorDarken(
                    KTApp.getSettings()["colors"]["theme"]["base"]["danger"],
                    20
                );
                var fillColor = KTUtil.colorDarken(
                    KTApp.getSettings()["colors"]["theme"]["base"]["danger"],
                    10
                );



                var options = {
                    series: [{
                        name: "Posts",
                        data: [
                            month_1,
                            month_2,
                            month_3,
                            month_4,
                            month_5,
                            month_6,
                        ],
                    }, ],
                    chart: {
                        type: "area",
                        height: height,
                        zoom: {
                            enabled: false,
                        },
                        sparkline: {
                            enabled: true,
                        },
                        padding: {
                            top: 0,
                            bottom: 0,
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    fill: {
                        type: "solid",
                        opacity: 1,
                    },
                    stroke: {
                        curve: "smooth",
                        show: true,
                        width: 3,
                        colors: [strokeColor],
                    },
                    xaxis: {
                        categories: ["jan", "Feb", "Mar", "Apr", "May", "June"],
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false,
                        },
                        labels: {
                            show: false,
                            style: {
                                colors: KTApp.getSettings()["colors"]["gray"][
                                    "gray-500"
                                ],
                                fontSize: "12px",
                                fontFamily: KTApp.getSettings()["font-family"],
                            },
                        },
                        crosshairs: {
                            show: false,
                            position: "front",
                            stroke: {
                                color: KTApp.getSettings()["colors"]["gray"][
                                    "gray-300"
                                ],
                                width: 1,
                                dashArray: 3,
                            },
                        },
                    },
                    yaxis: {
                        min: 0,
                        max: max_value,
                        labels: {
                            show: false,
                            style: {
                                colors: KTApp.getSettings()["colors"]["gray"][
                                    "gray-500"
                                ],
                                fontSize: "12px",
                                fontFamily: KTApp.getSettings()["font-family"],
                            },
                        },
                    },
                    states: {
                        normal: {
                            filter: {
                                type: "none",
                                value: 0,
                            },
                        },
                        hover: {
                            filter: {
                                type: "none",
                                value: 0,
                            },
                        },
                        active: {
                            allowMultipleDataPointsSelection: false,
                            filter: {
                                type: "none",
                                value: 0,
                            },
                        },
                    },
                    tooltip: {
                        style: {
                            fontSize: "12px",
                            fontFamily: KTApp.getSettings()["font-family"],
                        },
                        fixed: {
                            enabled: false,
                        },
                        x: {
                            show: false,
                        },
                        y: {
                            title: {
                                formatter: function(val) {
                                    return val + "";
                                },
                            },
                        },
                    },
                    colors: [fillColor],
                    markers: {
                        colors: [
                            KTApp.getSettings()["colors"]["theme"]["light"][
                                "danger"
                            ],
                        ],
                        strokeColor: [strokeColor],
                        strokeWidth: 3,
                    },
                };

                var chart = new ApexCharts(element, options);
                chart.render();
            },
        });
    };
    var _initTilesWidget5 = function() {
        var month_1 = 0;
        var month_2 = 0;
        var month_3 = 0;
        var month_4 = 0;
        var month_5 = 0;
        var month_6 = 0;

        var title = '';
        var post_count = 0;

        $.ajax({
            type: "get",
            url: chart_url,
            success: function(data) {
                var list = JSON.parse(data);

                month_1 = list[3].jan_count;
                month_2 = list[3].fep_count;
                month_3 = list[3].mar_count;
                month_4 = list[3].apr_count;
                month_5 = list[3].may_count;
                month_6 = list[3].june_count;

                var max_value = Math.max(month_1, month_2, month_3, month_4, month_5, month_6);
                title = list[3].name;
                post_count = list[3].post_count;

                document.getElementById(
                    "kt_tiles_widget_5_chart_title"
                ).innerHTML = title + " Status";
                document.getElementById(
                    "kt_tiles_widget_5_chart_count"
                ).innerHTML = post_count;

                //take data and catogries
                var element = document.getElementById(
                    "kt_tiles_widget_5_chart"
                );

                document.getElementById(
                    "kt_tiles_widget_5_chart_div"
                ).style.backgroundColor = list[3].color;


                var height = parseInt(KTUtil.css(element, "height"));

                if (!element) {
                    return;
                }

                var strokeColor = KTUtil.colorDarken(
                    KTApp.getSettings()["colors"]["theme"]["base"]["danger"],
                    20
                );
                var fillColor = KTUtil.colorDarken(
                    KTApp.getSettings()["colors"]["theme"]["base"]["danger"],
                    10
                );



                var options = {
                    series: [{
                        name: "Posts",
                        data: [
                            month_1,
                            month_2,
                            month_3,
                            month_4,
                            month_5,
                            month_6,
                        ],
                    }, ],
                    chart: {
                        type: "area",
                        height: height,
                        zoom: {
                            enabled: false,
                        },
                        sparkline: {
                            enabled: true,
                        },
                        padding: {
                            top: 0,
                            bottom: 0,
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    fill: {
                        type: "solid",
                        opacity: 1,
                    },
                    stroke: {
                        curve: "smooth",
                        show: true,
                        width: 3,
                        colors: [strokeColor],
                    },
                    xaxis: {
                        categories: ["jan", "Feb", "Mar", "Apr", "May", "June"],
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false,
                        },
                        labels: {
                            show: false,
                            style: {
                                colors: KTApp.getSettings()["colors"]["gray"][
                                    "gray-500"
                                ],
                                fontSize: "12px",
                                fontFamily: KTApp.getSettings()["font-family"],
                            },
                        },
                        crosshairs: {
                            show: false,
                            position: "front",
                            stroke: {
                                color: KTApp.getSettings()["colors"]["gray"][
                                    "gray-300"
                                ],
                                width: 1,
                                dashArray: 3,
                            },
                        },
                    },
                    yaxis: {
                        min: 0,
                        max: max_value,
                        labels: {
                            show: false,
                            style: {
                                colors: KTApp.getSettings()["colors"]["gray"][
                                    "gray-500"
                                ],
                                fontSize: "12px",
                                fontFamily: KTApp.getSettings()["font-family"],
                            },
                        },
                    },
                    states: {
                        normal: {
                            filter: {
                                type: "none",
                                value: 0,
                            },
                        },
                        hover: {
                            filter: {
                                type: "none",
                                value: 0,
                            },
                        },
                        active: {
                            allowMultipleDataPointsSelection: false,
                            filter: {
                                type: "none",
                                value: 0,
                            },
                        },
                    },
                    tooltip: {
                        style: {
                            fontSize: "12px",
                            fontFamily: KTApp.getSettings()["font-family"],
                        },
                        fixed: {
                            enabled: false,
                        },
                        x: {
                            show: false,
                        },
                        y: {
                            title: {
                                formatter: function(val) {
                                    return val + "";
                                },
                            },
                        },
                    },
                    colors: [fillColor],
                    markers: {
                        colors: [
                            KTApp.getSettings()["colors"]["theme"]["light"][
                                "danger"
                            ],
                        ],
                        strokeColor: [strokeColor],
                        strokeWidth: 3,
                    },
                };

                var chart = new ApexCharts(element, options);
                chart.render();
            },
        });
    };

    // Public methods
    return {
        init: function() {
            _initTilesWidget2();
            _initTilesWidget3();
            _initTilesWidget4();
            _initTilesWidget5();


        },
    };
})();

// Webpack support
if (typeof module !== "undefined") {
    module.exports = KTWidgets;
}

jQuery(document).ready(function() {
    KTWidgets.init();
});
