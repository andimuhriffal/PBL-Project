function fetchAndUpdateTable() {
    fetch("/api/get-iot")
        .then((res) => res.json())
        .then((data) => {
            if (!data) return;

            const row = document.createElement("tr");
            row.classList.add("smooth-enter");

            row.innerHTML = `
                <td>${data.suhu}°C</td>
                <td>${renderStatusSuhu(data.suhu)}</td>
                <td>${data.persentase_air}%</td>
                <td>${renderStatusAir(data.persentase_air)}</td>
                <td>${data.kelembapan}%</td>
                <td>${renderStatusKelembapan(data.kelembapan)}</td>
                <td>${data.waktu_pagi}</td>
                <td>${data.waktu_sore}</td>
                <td>${renderStatusPakan(data.status_pakan)}</td>
                <td>${new Date(data.created_at).toLocaleString("id-ID")}</td>
            `;

            const tableBody = document.getElementById("realtime-table");
            tableBody.appendChild(row);
            setTimeout(() => {
                row.classList.add("smooth-show");
            }, 50);

            const rows = tableBody.querySelectorAll("tr");
            if (rows.length > 1) {
                tableBody.removeChild(rows[0]);
            }
        })
        .catch((err) => console.error("Gagal fetch data tabel:", err));
}

// --- Reusable Status Renderers ---
function renderStatusSuhu(suhu) {
    if (suhu < 21) return `<span class="badge bg-primary">Dingin</span>`;
    if (suhu > 30) return `<span class="badge bg-warning text-dark">Hangat</span>`;
    return `<span class="badge bg-success">Normal</span>`;
}

function renderStatusAir(persen) {
    if (persen <= 0) return `<span class="badge bg-danger">Air Kosong</span>`;
    if (persen < 50) return `<span class="badge bg-warning text-dark">Air Hampir Habis</span>`;
    return `<span class="badge bg-success">Air Terisi</span>`;
}

function renderStatusKelembapan(kelembapan) {
    if (kelembapan > 90) return `<span class="badge bg-warning text-dark">Sangat Lembab</span>`;
    if (kelembapan < 30) return `<span class="badge bg-primary">Kering</span>`;
    return `<span class="badge bg-success">Normal</span>`;
}

function renderStatusPakan(status) {
    if (status === "Waktu pakan telah diset") {
        return `<span class="badge bg-info text-dark">Menunggu pemberian</span>`;
    } else if (status === "Pakan ayam telah diberikan") {
        return `<span class="badge bg-success">Sudah Diberikan</span>`;
    } else {
        return `<span class="badge bg-secondary">-</span>`;
    }
}

// Inisialisasi
fetchAndUpdateTable();
setInterval(fetchAndUpdateTable, 3000);
