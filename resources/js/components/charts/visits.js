new Chart(ctxVisits, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: label,
            data: data,
            borderWidth: 1,
            backgroundColor: backgroundColor,
        }]
    },
    options: {
        plugins: {
            responsive: true,
            title: {
                display: true,
                text: text,
            },
            legend: {
                display: false
            },
        },
        scales: {
            y: {
                ticks: {
                    beginAtZero: true,
                    stepSize: 1,
                }
            }
        }
    },
});