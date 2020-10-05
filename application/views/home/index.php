<?php
/**
 * Created by PhpStorm.
 * User: HappyMario
 * Date: 3/23/2020
 * Time: 5:20 PM
 */
//폼검증 에러 표출
?>


<style>
    .main-padding {
        padding-left: 56px;
        padding-right:56px;
    }
</style>

<div class="row">
    <div class="col-md-12" style="margin-top: 20px;">
        <span style="font-weight: bold;font-size: 16px;"><?=t('plan_graph')?></span>
        <span style="display:inline-block;border:1px solid black;height:10px;width:17px"/>
    </div>
    <div class="col-md-12 main-padding" style="margin-top: 20px;">
        <!-- BEGIN CHART PORTLET-->
        <div class="col-md-5 portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bar-chart font-green-haze"></i>
                    <span class="caption-subject bold uppercase font-green-haze"><?=t('team')?>1</span>
                </div>
            </div>
            <div class="portlet-body">
                <svg width="500" height="300" id="chat_barchart"/>
            </div>
            <div class="col-md-12" style="text-align: center">
                <svg width="180" height="30">
                    <g>
                        <rect x="0" y="0" width="20" height="20" fill="#3185FC"></rect>
                        <text x="22" y="15" font-family="Verdana" font-size="14" fill="#3185FC" class="last2month">3<?=t('month')?></text>
                    </g>

                    <g>
                        <rect x="60" y="0" width="20" height="20" fill="#ff8c00"></rect>
                        <text x="82" y="15" font-family="Verdana" font-size="14" fill="#ff8c00" class="lastmonth">4<?=t('month')?></text>
                    </g>

                    <g>
                        <rect x="120" y="0" width="20" height="20" fill="#8a89a6"></rect>
                        <text x="142" y="15" font-family="Verdana" font-size="14" fill="#8a89a6" class="curmonth">5<?=t('month')?></text>
                    </g>
                </svg>
            </div>
        </div>
        <!-- END CHART PORTLET-->

        <!-- BEGIN CHART PORTLET-->
        <div class="col-md-5 portlet light bordered" style="margin-left: 10px;">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bar-chart font-green-haze"></i>
                    <span class="caption-subject bold uppercase font-green-haze"> <?=t('plan_pie')?></span>
                </div>
            </div>
            <div class="portlet-body" style="text-align: center;">
                <svg width="300" height="300" id="chat_pie" />
            </div>
            <div class="col-md-12" style="text-align: center">
                <svg width="320" height="30">
                    <g>
                        <rect x="0" y="0" width="20" height="20" fill="#3185FC"></rect>
                        <text x="22" y="15" font-family="Verdana" font-size="14" fill="#3185FC"><?=t('team')?>1</text>
                    </g>

                    <g>
                        <rect x="80" y="0" width="20" height="20" fill="#ff8c00"></rect>
                        <text x="102" y="15" font-family="Verdana" font-size="14" fill="#ff8c00"><?=t('team')?>2</text>
                    </g>

                    <g>
                        <rect x="160" y="0" width="20" height="20" fill="#8a89a6"></rect>
                        <text x="182" y="15" font-family="Verdana" font-size="14" fill="#8a89a6"><?=t('team')?>3</text>
                    </g>

                    <g>
                        <rect x="240" y="0" width="20" height="20" fill="#ff2200"></rect>
                        <text x="262" y="15" font-family="Verdana" font-size="14" fill="#ff2200"><?=t('team')?>4</text>
                    </g>
                </svg>
            </div>
        </div>
        <!-- END CHART PORTLET-->
    </div>
</div>

<script>
    var maxHeight = 4000;
    $(function () {
        const data = Object.assign([{State:"<?=t('plan')?>", last2month:1000, lastmonth:2000, curmonth:3000}, {State:'<?=t('sum_up')?>', last2month:1200, lastmonth:2200, curmonth:3200}], {y: "$"});
        initBarChart("#chat_barchart", data);

        var team = '<?=t('team')?>';
        const piedata = [{name:team+"1", value:1000}, {name:team+"2", value:2000}, {name:team+"3", value:3000}, {name:team+"4", value:4000}];
        initPieChart("#chat_pie", piedata);
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
            .attr("width", x1.bandwidth()/4*3)
            .attr("height", d => y(0) - y(d.value))
            .attr("fill", d => color(d.key));

        var titledata = [data[0][keys[0]], data[0][keys[1]], data[0][keys[2]],data[1][keys[0]], data[1][keys[1]], data[1][keys[2]]];
        svg.append("g")
            .attr("font-family", "sans-serif")
            .attr("font-size", 10)
            .selectAll("text")
            .data(titledata)
            .join("text")
            .attr("text-anchor", d => d.value < 0 ? "end" : "start")
            .attr("x",  (d, i) => (x1.bandwidth()/4*3 + 18) * i + 80 + (i >= 3? 64:0))
            .attr("y", d => y(d)-2)
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
</script>