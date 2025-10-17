import Chart from "chart.js/auto";
let chart;
let chartLinear;
// Espera a que el DOM esté listo
document.addEventListener("DOMContentLoaded", () => {
    const ctx = document.getElementById("cryptoChart");
    const ctxL = document.getElementById("cryptoChartLinear");

    let datosFormacion = {
        type: "bar",
        data: {
            labels: [],
            datasets: [
                {
                    label: "Precio en USD",
                    data: [],
                    borderWidth: 1,
                    backgroundColor: "rgba(37, 99, 235, 0.5)",
                    borderColor: "rgb(37, 99, 235)",
                },
            ],
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    };

    let datosFormacionLinear = {
        type: "line",
        data: {
            labels: [],
            datasets: [
                {
                    label: "Precio en USD",
                    data: [],
                    borderWidth: 1,
                    backgroundColor: "rgba(37, 99, 235, 0.5)",
                    borderColor: "rgb(37, 99, 235)",
                },
            ],
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    };

    if (ctx) {
        chart = new Chart(ctx, datosFormacion);
    }
    if (ctxL) {
        chartLinear = new Chart(ctxL, datosFormacionLinear);
    }

    let selector = document.getElementById("cryptoSelector");
    selector.addEventListener("change", (event) => {
        let valor = event.target.value;
        fetchCryptoData(valor);
    });

    let selectorLinear = document.getElementById("cryptoSelectorLinear");
    selectorLinear.addEventListener("change", (event) => {
        let valor = event.target.value;
        fetchHistoricalData(valor);
    });

    setInterval(() => {
        const selectedCrypto = selector.value || "all";
        fetchCryptoData(selectedCrypto);
    }, 60000); // 60000 ms = 60 segundos

    selector.selectedIndex = 0;
});

function fetchCryptoData(selectedCrypto) {
    fetch(`/crypto/data?symbol=${selectedCrypto}`)
        .then((response) => response.json())
        .then((data) => {
            // console.log(data);
            // Aquí puedes actualizar tu gráfico con los datos obtenidos
            updateChart(data.data);
        })
        .catch((error) => console.error("Error fetching crypto data:", error));
}

function fetchHistoricalData(symbol) {
    let time_start = document.getElementById("timeStart").value;
    let time_end = document.getElementById("timeEnd").value;

    const token = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    fetch(`/crypto/historical`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
            "X-CSRF-TOKEN": token,
        },
        body: JSON.stringify({
            symbol: symbol,
            time_start: time_start,
            time_end: time_end,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            // Aquí puedes actualizar tu gráfico con los datos obtenidos
            // updateChart(data.data);
        });
}

function updateChart(data) {
    // Lógica para actualizar el gráfico con los nuevos datos
    let cryptos = Object.values(data);
    console.log(cryptos);
    chart.data.labels = cryptos.map((crypto) => crypto.name);
    chart.data.datasets[0].data = cryptos.map(
        (crypto) => crypto.quote.USD.price
    );
    chart.update();
}
