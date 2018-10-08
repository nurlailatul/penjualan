
// Define a plugin to provide data labels
function format1(input) {
    return input.toFixed(0).replace(/./g, function(c, i, a) {
        return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "." + c : c;
    });
}
Chart.plugins.register({
    afterDatasetsDraw: function(chart) {
        var ctx = chart.ctx;

        chart.data.datasets.forEach(function(dataset, i) {
            var meta = chart.getDatasetMeta(i);
            if (!meta.hidden) {
                meta.data.forEach(function(element, index) {
                    // Draw the text in black, with the specified font
                    ctx.fillStyle = 'rgb(47, 79, 79)';

                    var fontSize = 16;
                    var fontStyle = 'normal';
                    var fontFamily = 'Helvetica Neue';
                    ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);

                    // Just naively convert to string for now
                    var dataString = format1(dataset.data[index]).toString();
                    if (typeof percentage_label !== 'undefined') {
                        dataString += ' %';
                    }

                    // Make sure alignment settings are correct
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';

                    var padding = 5;
                    var position = element.tooltipPosition();
                    var position_x = position.x;
                    var position_y = position.y;

                    if (typeof horizontal_bar !== 'undefined') {
                        position_x = position.x + (fontSize / 2) + padding;
                    } else {
                        position_y = position.y - (fontSize / 2) - padding
                    }

                    ctx.fillText(dataString, position_x, position_y);
                });
            }
        });
    }
});