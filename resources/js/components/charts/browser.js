var ctxBrowser = document.querySelector(id);

new Chart(ctxBrowser, {
    type: 'pie',
    data: {
        labels: labels,
        datasets: [{
            data: data,
            borderWidth: 1,
        }]
    },
    options: {
        plugins: {
            responsive: true,
            title: {
                display: true,
                text: text
            },
        },
        scales: {
            y: {
                display: false,
            }
        }
    },
});