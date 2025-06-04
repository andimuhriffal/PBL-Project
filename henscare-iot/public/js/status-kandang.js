// Ambil status perangkat dan update tampilan
function fetchKandangStatusAndUpdate() {
    fetch("/api/get-iot")
        .then((response) => response.json())
        .then((data) => {
            updateLampuStatus(data.lampu_status === true ? "ON" : "OFF");
            updateFanStatus(data.kipas_status === true ? "ON" : "OFF");
            updateKranStatus(data.kran_terbuka === true ? "TERBUKA" : "TERTUTUP");
        })
        .catch((error) => console.error("Gagal memuat data:", error));
}

function updateLampuStatus(status) {
    const lampuImage = document.getElementById("lampu-gambar");
    const lampuText = document.getElementById("lampu-status");
    if (lampuImage && lampuText) {
        lampuImage.src = status === "ON" ? "/images/light_on.png" : "/images/light_off.png";
        lampuText.innerText = status;
    }
}

function updateFanStatus(status) {
    const fanImage = document.getElementById("fan-gambar");
    const fanText = document.getElementById("fan-status");
    if (fanImage && fanText) {
        fanImage.src = status === "ON" ? "/images/fan_on.png" : "/images/fan_off.png";
        fanText.innerText = status;
    }
}

function updateKranStatus(status) {
    const kranImage = document.getElementById("kran-gambar");
    const kranText = document.getElementById("kran-status");
    if (kranImage && kranText) {
        kranImage.src = status === "TERBUKA" ? "/images/water_on.png" : "/images/water_off.png";
        kranText.innerText = status;
    }
}

// Jalankan fetch dan update otomatis saat DOM siap, dan refresh tiap 5 detik
document.addEventListener("DOMContentLoaded", () => {
    fetchKandangStatusAndUpdate();
    setInterval(fetchKandangStatusAndUpdate, 5000);
});
