var ctxBounceRate = document.querySelector(id);

new Chart(ctxBounceRate, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: label,
            data: data,
            borderWidth: 2,
            backgroundColor: backgroundColor,
            borderColor: borderColor,
            pointStyle: 'circle',
            pointRadius: 2,
            pointHoverRadius: 5
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: text,
            },
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let label = context.dataset.label;
                        let value = context.formattedValue || 0;
                        return label + ': ' + value + '%';
                    }
                }
            },
        },
        interaction: {
            mode: 'index',
            intersect: false
        },
        scales: {
            y: {
                display: true,
                ticks: {
                    beginAtZero: true,
                    stepSize: 20,
                    callback: function(value, index, values) {
                        return value + '%';
                    }
                }
            },
        },  
    },
});