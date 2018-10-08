
function getBoxWidth(labelOpts, fontSize) {
    return labelOpts.usePointStyle ?
        fontSize * Math.SQRT2 :
        labelOpts.boxWidth;
};

Chart.NewLegend = Chart.Legend.extend({
    afterFit: function() {
        this.height = this.height + 50;
    },
});

function createNewLegendAndAttach(chartInstance, legendOpts) {
    var legend = new Chart.NewLegend({
        ctx: chartInstance.chart.ctx,
        options: legendOpts,
        chart: chartInstance
    });

    if (chartInstance.legend) {
        Chart.layoutService.removeBox(chartInstance, chartInstance.legend);
        delete chartInstance.newLegend;
    }

    chartInstance.newLegend = legend;
    Chart.layoutService.addBox(chartInstance, legend);
}

// Register the legend plugin
Chart.plugins.register({
    beforeInit: function(chartInstance) {
        var legendOpts = chartInstance.options.legend;

        if (legendOpts) {
            createNewLegendAndAttach(chartInstance, legendOpts);
        }
    },
    beforeUpdate: function(chartInstance) {
        var legendOpts = chartInstance.options.legend;

        if (legendOpts) {
            legendOpts = Chart.helpers.configMerge(Chart.defaults.global.legend, legendOpts);

            if (chartInstance.newLegend) {
                chartInstance.newLegend.options = legendOpts;
            } else {
                createNewLegendAndAttach(chartInstance, legendOpts);
            }
        } else {
            Chart.layoutService.removeBox(chartInstance, chartInstance.newLegend);
            delete chartInstance.newLegend;
        }
    },
    afterEvent: function(chartInstance, e) {
        var legend = chartInstance.newLegend;
        if (legend) {
            legend.handleEvent(e);
        }
    }
});