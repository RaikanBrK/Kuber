var ctxBrowserBar = document.querySelector(id);

new Chart(ctxBrowserBar, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: data,
    },
    options: {
        responsive: true,
        scales: {
            x: {
                stacked: true,
            },
            y: {
                stacked: true
            }
        }
    },
});