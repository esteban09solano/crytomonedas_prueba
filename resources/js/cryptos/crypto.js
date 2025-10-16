import Chart from "chart.js/auto";
let chart;
// Espera a que el DOM esté listo
document.addEventListener("DOMContentLoaded", () => {
    const ctx = document.getElementById("cryptoChart");

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

    if (ctx) {
        chart = new Chart(ctx, datosFormacion);
    }

    let selector = document.getElementById("cryptoSelector");
    selector.addEventListener("change", (event) => {
        let valor = event.target.value;
        fetchCryptoData(valor);
    });

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
