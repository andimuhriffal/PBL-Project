// chart.js

// Inisialisasi semua chart saat halaman siap
function initCharts() {
    FusionCharts.ready(function () {
        new FusionCharts({
            id: "suhuChart",
            type: "thermometer",
            renderAt: "chart-temp",
            width: "100%",
            height: "240",
            dataFormat: "json",
            dataSource: {
                chart: {
                    lowerLimit: "-10",
                    upperLimit: "50",
                    numberSuffix: "°C",
                    thmFillColor: "#f45b00",
                    showhovereffect: "1",
                    showGaugeBorder: "1",
                    chartBottomMargin: "20",
                    theme: "fusion",
                },
                value: 0,
            },
        }).render();

        new FusionCharts({
            id: "kelembapanChart",
            type: "thermometer",
            renderAt: "chart-humidity",
            width: "100%",
            height: "240",
            dataFormat: "json",
            dataSource: {
                chart: {
                    lowerLimit: "0",
                    upperLimit: "100",
                    numberSuffix: "%",
                    thmFillColor: "#0075c2",
                    showhovereffect: "1",
                    showGaugeBorder: "1",
                    chartBottomMargin: "20",
                    theme: "fusion",
                },
                value: 0,
            },
        }).render();

        new FusionCharts({
            id: "tinggiAirChart",
            type: "cylinder",
            renderAt: "chart-tinggi-air",
            width: "100%",
            height: "275",
            dataFormat: "json",
            dataSource: {
                chart: {
                    theme: "fusion",
                    caption: "",
                    lowerLimit: "0",
                    upperLimit: "4",
                    lowerLimitDisplay: "Kosong",
                    upperLimitDisplay: "Penuh",
                    numberSuffix: " cm",
                    showValue: "1",
                    chartBottomMargin: "30",
                    cylFillColor: "#0075c2",
                },
                value: 0,
            },
        }).render();
    });
}

// Fungsi animasi perubahan nilai chart
function animateChartValue(chartId, newValue, duration = 500) {
    const chart = FusionCharts.items[chartId];
    if (!chart) return;

    const currentValue = parseFloat(chart.getData());
    const stepCount = 20;
    const stepTime = duration / stepCount;
    const valueDiff = newValue - currentValue;

    let step = 0;
    const interval = setInterval(() => {
        step++;
        const interpolatedValue = currentValue + valueDiff * (step / stepCount);
        chart.setData(interpolatedValue.toFixed(2));
        if (step >= stepCount) {
            clearInterval(interval);
            chart.setData(newValue);
        }
    }, stepTime);
}

// Fungsi fetch data dan update chart + nilai teks
function fetchAndUpdateCharts() {
    fetch("/api/get-iot")
        .then((response) => response.json())
        .then((data) => {
            const suhuValue = data.suhu;
            const kelembapanValue = data.kelembapan;
            const tinggiAirSensor = parseFloat(data.tinggi_air); // Misalnya: 15.17

            const tinggiTabungCm = 15.17;
            const displayMax = 4;
            let tinggiAirAktual = tinggiTabungCm - tinggiAirSensor;
            let normalizedTinggiAir =
                (tinggiAirAktual / tinggiTabungCm) * displayMax;

            if (normalizedTinggiAir > displayMax)
                normalizedTinggiAir = displayMax;
            if (normalizedTinggiAir < 0) normalizedTinggiAir = 0;

            animateChartValue("suhuChart", suhuValue);
            document.getElementById("suhu-value").innerText = suhuValue + " °C";

            animateChartValue("kelembapanChart", kelembapanValue);
            document.getElementById("kelembapan-value").innerText =
                kelembapanValue + " %";

            animateChartValue("tinggiAirChart", normalizedTinggiAir.toFixed(2));
        })
        .catch((error) => console.error("Gagal memuat data chart:", error));
}

window.initCharts = initCharts;
window.animateChartValue = animateChartValue;
window.fetchAndUpdateCharts = fetchAndUpdateCharts;

document.addEventListener("DOMContentLoaded", function () {
    initCharts();
    fetchAndUpdateCharts();
    setInterval(fetchAndUpdateCharts, 3000); // Update setiap 3 detik
});
