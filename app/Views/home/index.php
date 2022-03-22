<?php
/**
 * Created by PhpStorm.
 * User: HappyMario
 * Date: 3/23/2020
 * Time: 5:20 PM
 */
?>

<!--begin::Toolbar-->
<div class="toolbar toolbar-fixed bg-transparent pt-6 mb-5" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1"><?=t('site_name');?></h1>
            <!--end::Title-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
            <div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left" class="btn btn-sm btn-white btn-active-white btn-active-color-primary d-flex align-items-center px-4">
                <!--begin::Display range-->
                <div class="text-gray-600 fw-bolder">Loading date range...</div>
                <!--end::Display range-->
                <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                <span class="svg-icon svg-icon-1 ms-2 me-0">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="black" />
												<path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="black" />
												<path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="black" />
											</svg>
										</span>
                <!--end::Svg Icon-->
            </div>
            <!--end::Daterangepicker-->
            <!--begin::Secondary button-->
            <!--end::Secondary button-->
            <!--begin::Primary button-->
            <a href="../../demo1/dist/.html" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_new_target">Add Goal</a>
            <!--end::Primary button-->
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Container-->
</div>
<!--end::Toolbar-->

<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <!--begin::Row-->
        <div class="row gx-5 gx-xl-10">
            <!--begin::Col-->
            <div class="col-xxl-6 mb-5 mb-xl-10">
                <!--begin::Chart widget 27-->
                <div class="card card-flush h-xl-100">
                    <!--begin::Header-->
                    <div class="card-header py-7">
                        <!--begin::Statistics-->
                        <div class="m-0">
                            <!--begin::Heading-->
                            <div class="d-flex align-items-center mb-2">
                                <span style="font-weight: bold;font-size: 16px;">ChartJS <?= t('plan_graph') ?></span>
                                <span style="display:inline-block;border:1px solid black;height:10px;width:17px; background: red;"/>
                            </div>
                            <!--begin::Heading-->
                        </div>
                        <!--end::Statistics-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-0 pb-1">
                        <div id="kt_charts_widget_27" class="min-h-auto">
                            <div style="flex: 1;">
                                <canvas id="myChart"></canvas>
                            </div>

                            <div style="flex: 1;">
                            </div>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Chart widget 27-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row gx-5 gx-xl-10">
            <!--begin::Col-->
            <div class="col-xxl-6 mb-5 mb-xl-10">
                <!--begin::Chart widget 27-->
                <div class="card card-flush h-xl-100">
                    <!--begin::Header-->
                    <div class="card-header py-7">
                        <!--begin::Statistics-->
                        <div class="m-0">
                            <!--begin::Heading-->
                            <div class="d-flex align-items-center mb-2">
                                <span style="font-weight: bold;font-size: 16px;">D3 <?= t('plan_graph') ?>(Data Driven Documents: 대용량자료 시각화)</span>
                                <span style="display:inline-block;border:1px solid black;height:10px;width:17px; background: red;"/>
                            </div>
                            <!--begin::Heading-->
                        </div>
                        <!--end::Statistics-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-0 pb-1">
                        <div id="kt_charts_widget_27" class="min-h-auto">
                            <!-- BEGIN CHART PORTLET-->
                            <div style="flex: 1;">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-bar-chart font-green-haze"></i>
                                        <span class="caption-subject bold uppercase font-green-haze"><?= t('team') ?>1</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <svg width="500" height="300" id="chat_barchart"/>
                                </div>
                                <div class="col-md-12" style="text-align: center">
                                    <svg width="180" height="30">
                                        <g>
                                            <rect x="0" y="0" width="20" height="20" fill="#3185FC"></rect>
                                            <text x="22" y="15" font-family="Verdana" font-size="14" fill="#3185FC" class="last2month">
                                                3<?= t('month') ?></text>
                                        </g>

                                        <g>
                                            <rect x="60" y="0" width="20" height="20" fill="#ff8c00"></rect>
                                            <text x="82" y="15" font-family="Verdana" font-size="14" fill="#ff8c00" class="lastmonth">
                                                4<?= t('month') ?></text>
                                        </g>

                                        <g>
                                            <rect x="120" y="0" width="20" height="20" fill="#8a89a6"></rect>
                                            <text x="142" y="15" font-family="Verdana" font-size="14" fill="#8a89a6" class="curmonth">
                                                5<?= t('month') ?></text>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                            <!-- END CHART PORTLET-->
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Chart widget 27-->
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-xxl-6 mb-5 mb-xl-10">
                <!--begin::Chart widget 27-->
                <div class="card card-flush h-xl-100">
                    <!--begin::Header-->
                    <div class="card-header py-7">
                        <!--begin::Statistics-->
                        <div class="m-0">
                            <!--begin::Heading-->
                            <div class="d-flex align-items-center mb-2">
                                <span style="font-weight: bold;font-size: 16px;"><?= t('plan_pie') ?></span>
                                <span style="display:inline-block;border:1px solid black;height:10px;width:17px; background: red;"/>
                            </div>
                            <!--begin::Heading-->
                        </div>
                        <!--end::Statistics-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-0 pb-1">
                        <div id="kt_charts_widget_27" class="min-h-auto">
                            <!-- BEGIN CHART PORTLET-->
                            <div style="flex: 1;">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-bar-chart font-green-haze"></i>
                                        <span class="caption-subject bold uppercase font-green-haze"> <?= t('plan_pie') ?></span>
                                    </div>
                                </div>
                                <div class="portlet-body" style="text-align: center;">
                                    <svg width="300" height="300" id="chat_pie"/>
                                </div>
                                <div class="col-md-12" style="text-align: center">
                                    <svg width="320" height="30">
                                        <g>
                                            <rect x="0" y="0" width="20" height="20" fill="#3185FC"></rect>
                                            <text x="22" y="15" font-family="Verdana" font-size="14" fill="#3185FC"><?= t('team') ?>1
                                            </text>
                                        </g>

                                        <g>
                                            <rect x="80" y="0" width="20" height="20" fill="#ff8c00"></rect>
                                            <text x="102" y="15" font-family="Verdana" font-size="14" fill="#ff8c00"><?= t('team') ?>2
                                            </text>
                                        </g>

                                        <g>
                                            <rect x="160" y="0" width="20" height="20" fill="#8a89a6"></rect>
                                            <text x="182" y="15" font-family="Verdana" font-size="14" fill="#8a89a6"><?= t('team') ?>3
                                            </text>
                                        </g>

                                        <g>
                                            <rect x="240" y="0" width="20" height="20" fill="#ff2200"></rect>
                                            <text x="262" y="15" font-family="Verdana" font-size="14" fill="#ff2200"><?= t('team') ?>4
                                            </text>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                            <!-- END CHART PORTLET-->
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Chart widget 27-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
<!--end::Post-->

<script>
    var maxHeight = 4000;
    $(function () {
        const data = Object.assign([{
            State: "<?=t('plan')?>",
            last2month: 1000,
            lastmonth: 2000,
            curmonth: 3000
        }, {State: '<?=t('sum_up')?>', last2month: 1200, lastmonth: 2200, curmonth: 3200}], {y: "$"});
        initBarChart("#chat_barchart", data);

        var team = '<?=t('team')?>';
        const piedata = [{name: team + "1", value: 1000}, {name: team + "2", value: 2000}, {
            name: team + "3",
            value: 3000
        }, {name: team + "4", value: 4000}];
        initPieChart("#chat_pie", piedata);

        initChartJS();
    });

    function initBarChart(id, data) {
        const keys = ["last2month", "lastmonth", "curmonth"];
        const groupKey = "State";
        const width = 500, height = 300;
        const margin = ({top: 10, right: 10, bottom: 20, left: 40});

        const x0 = d3.scaleBand()
            .domain(data.map(d => d[groupKey]))
            .rangeRound([margin.left, width - margin.right])
            .paddingInner(0.1);

        const x1 = d3.scaleBand()
            .domain(keys)
            .rangeRound([40, x0.bandwidth()])
            .padding(0.05);

        const y = d3.scaleLinear()
            .domain([0, maxHeight]).nice()
            .rangeRound([height - margin.bottom, margin.top]);

        const color = d3.scaleOrdinal()
            .range(["#3185FC", "#ff8c00", "#8a89a6"])
        const xAxis = g => g
            .attr("transform", `translate(12,${height - margin.bottom})`)
            .call(d3.axisBottom(x0).tickSizeOuter(0))
            .call(g => g.select(".domain").remove());
        const yAxis = g => g
            .attr("transform", `translate(${margin.left},0)`)
            .call(d3.axisLeft(y).ticks(null, "s"))
            .call(g => g.select(".domain").remove())
            .call(g => g.select(".tick:last-of-type text").clone()
                .attr("x", 3)
                .attr("text-anchor", "start")
                .attr("font-weight", "bold")
                .text(data.y));

        var svg = d3.select(id);

        svg.append("g")
            .selectAll("g")
            .data(data)
            .join("g")
            .attr("transform", d => `translate(${x0(d[groupKey])},0)`)
            .selectAll("rect")
            .data(d => keys.map(key => ({key, value: d[key]})))
            .join("rect")
            .attr("x", d => x1(d.key))
            .attr("y", d => y(d.value))
            .attr("width", x1.bandwidth() / 4 * 3)
            .attr("height", d => y(0) - y(d.value))
            .attr("fill", d => color(d.key));

        var titledata = [data[0][keys[0]], data[0][keys[1]], data[0][keys[2]], data[1][keys[0]], data[1][keys[1]], data[1][keys[2]]];
        svg.append("g")
            .attr("font-family", "sans-serif")
            .attr("font-size", 10)
            .selectAll("text")
            .data(titledata)
            .join("text")
            .attr("text-anchor", d => d.value < 0 ? "end" : "start")
            .attr("x", (d, i) => (x1.bandwidth() / 4 * 3 + 18) * i + 80 + (i >= 3 ? 64 : 0))
            .attr("y", d => y(d) - 2)
            .attr("dx", "0.35em")
            .text(d => d);

        svg.append("g")
            .call(xAxis);

        svg.append("g")
            .call(yAxis);
    }

    function initPieChart(id, data) {
        const width = 300, height = 300;
        const color = d3.scaleOrdinal()
            .domain(data.map(d => d.name))
            .range(["#3185FC", "#ff8c00", "#8a89a6", "#ff2200"])

        const arc = d3.arc()
            .innerRadius(0)
            .outerRadius(Math.min(width, height) / 2 - 1)

        const radius = Math.min(width, height) / 2 * 0.8;
        const arcLabel = d3.arc().innerRadius(radius).outerRadius(radius);
        const pie = d3.pie()
            .sort(null)
            .value(d => d.value)
        const arcs = pie(data);

        var svg = d3.select(id);
        svg.attr("viewBox", [-width / 2, -height / 2, width, height]);
        svg.append("g")
            .attr("stroke", "white")
            .selectAll("path")
            .data(arcs)
            .join("path")
            .attr("fill", d => color(d.data.name))
            .attr("d", arc)
            .append("title")
            .text(d => `${d.data.name}: ${d.data.value.toLocaleString()}`);

        svg.append("g")
            .attr("font-family", "sans-serif")
            .attr("font-size", 12)
            .attr("text-anchor", "middle")
            .selectAll("text")
            .data(arcs)
            .join("text")
            .attr("transform", d => `translate(${arcLabel.centroid(d)})`)
            .call(text => text.append("tspan")
                .attr("y", "-0.4em")
                .attr("font-weight", "bold")
                .text(d => d.data.name))
            .call(text => text.filter(d => (d.endAngle - d.startAngle) > 0.0).append("tspan")
                .attr("x", 0)
                .attr("y", "0.7em")
                .attr("fill-opacity", 0.7)
                .text(d => d.data.value.toLocaleString() + "$"));
    }

    function initChartJS() {
        const labels = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
        ];
        const data = {
            labels: labels,
            datasets: [{
                label: 'My First dataset',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [0, 10, 5, 2, 20, 30, 45],
            }]
        };

        const config = {
            type: 'line',
            data: data,
            options: {}
        };

        var myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    }
</script>

<script src="<?=base_url("assets/common/plugins/chartjs/chart.js")?>"></script>
