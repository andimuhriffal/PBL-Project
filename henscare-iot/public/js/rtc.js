const apiUrl = "http://rtc-service:8084/api/waktu";

let waktuPagi = null;
let waktuSore = null;
let sudahMakan = false;

const jamDigital = document.getElementById("jam-operasional-text");
const gambarAyam = document.getElementById("ayam-gambar");
const inputPagi = document.getElementById("waktu-pagi");
const inputSore = document.getElementById("waktu-sore");
const btnSetPakan = document.getElementById("btn-set-pakan");
const inputSection = inputPagi.closest(".mt-2");

// Buat tombol batal dan sisipkan setelah tombol simpan
let btnBatal = document.getElementById("btn-batal");
if (!btnBatal) {
    btnBatal = document.createElement("button");
    btnBatal.id = "btn-batal";
    btnBatal.className = "btn btn-sm btn-danger mt-3 w-100";
    btnBatal.textContent = "Batalkan Setelan";
    btnBatal.style.display = "none";
    btnSetPakan.parentNode.insertBefore(btnBatal, btnSetPakan.nextSibling);
}

function updateJam() {
    const now = new Date();
    const jam = now.getHours().toString().padStart(2, "0");
    const menit = now.getMinutes().toString().padStart(2, "0");
    const detik = now.getSeconds().toString().padStart(2, "0");
    const jamSekarang = `${jam}:${menit}`;

    jamDigital.textContent = `${jam}:${menit}:${detik}`;

    if (
        (jamSekarang === waktuPagi || jamSekarang === waktuSore) &&
        !sudahMakan
    ) {
        gambarAyam.src = "images/ayam-1.png";
        sudahMakan = true;
    } else if (jamSekarang !== waktuPagi && jamSekarang !== waktuSore) {
        gambarAyam.src = "images/ayam-2.png";
        sudahMakan = false;
    }
}

setInterval(updateJam, 1000);

function aktifkanModeJamDigital() {
    jamDigital.style.display = "block";
    inputSection.style.display = "none";
    btnSetPakan.style.display = "none";
    btnBatal.style.display = "block";
}

function aktifkanModeInput() {
    jamDigital.style.display = "none";
    inputSection.style.display = "block";
    btnSetPakan.style.display = "block";
    btnBatal.style.display = "none";
    waktuPagi = null;
    waktuSore = null;
    sudahMakan = false;
    gambarAyam.src = "images/ayam-2.png";
    inputPagi.value = "";
    inputSore.value = "";
    localStorage.removeItem("waktuPagi");
    localStorage.removeItem("waktuSore");
}

// Ambil data dari localStorage saat halaman dimuat
window.addEventListener("DOMContentLoaded", () => {
    const pagiStored = localStorage.getItem("waktuPagi");
    const soreStored = localStorage.getItem("waktuSore");
    if (pagiStored && soreStored) {
        waktuPagi = pagiStored;
        waktuSore = soreStored;
        aktifkanModeJamDigital();
    }
});

btnSetPakan.addEventListener("click", function () {
    const pagi = inputPagi.value;
    const sore = inputSore.value;

    if (pagi && sore) {
        waktuPagi = pagi;
        waktuSore = sore;

        localStorage.setItem("waktuPagi", waktuPagi);
        localStorage.setItem("waktuSore", waktuSore);

        aktifkanModeJamDigital();
        alert(`Waktu pakan diset:\nPagi: ${waktuPagi}\nSore: ${waktuSore}`);

        // Kirim ke backend Spring Boot
        kirimWaktuKeBackend(waktuPagi, waktuSore);
    } else {
        alert("Mohon isi kedua waktu pakan (pagi dan sore).");
    }
});

btnBatal.addEventListener("click", function () {
    aktifkanModeInput();
});

// Fungsi kirim ke backend
function kirimWaktuKeBackend(pagi, sore) {
    fetch(apiUrl, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            waktuPagi: pagi,
            waktuSore: sore,
        }),
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Gagal mengirim waktu ke backend.");
            }
            return response.json();
        })
        .then((data) => {
            console.log("Berhasil dikirim ke backend:", data);
        })
        .catch((error) => {
            console.error("Terjadi kesalahan:", error);
            alert("Gagal mengirim waktu ke server.");
        });
}
