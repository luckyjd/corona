function getLabel()
{
    var date = new Date();
    // Get number date of month
    var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
    var numberDateOfMonth = parseInt(lastDay.getDate());
    var r = [];
    for (var i = 1; i <= numberDateOfMonth; i++) {
        r.push(i);
    }
    return r;
}

function getConfigLineChart(data)
{
    return {
        type: 'line',
        data: {
            labels: getLabel(),
            datasets: data,
        },

        options: {
            legend: {
                display: false,
            },
        },
    }
}

var chart = $('#line_chart');
chart.each(function () {
    new Chart(this, getConfigLineChart(data));
});