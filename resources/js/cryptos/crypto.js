import Chart from "chart.js/auto";

// Espera a que el DOM esté listo
document.addEventListener("DOMContentLoaded", () => {
    const ctx = document.getElementById("cryptoChart");

    if (ctx) {
        const chart = new Chart(ctx, {
            type: "line",
            data: {
                labels: ["Bitcoin", "Ethereum", "Tether", "BNB", "Solana"],
                datasets: [
                    {
                        label: "Precio en USD",
                        data: [107928.93, 3853.32, 1.0, 1147.82, 183.5],
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
        });
    }
});

function fetchCryptoData() {
    fetch("/api/cryptos")
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            // Aquí puedes actualizar tu gráfico con los datos obtenidos
        })
        .catch((error) => console.error("Error fetching crypto data:", error));
}
