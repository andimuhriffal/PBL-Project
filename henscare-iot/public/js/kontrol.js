let deviceStates = {
    lampu: false,
    kipas: false,
    kran: false,
    motor: false,
};

let currentMode = 'manual'; // default mode

function setDeviceStates(newStates) {
    deviceStates = {...deviceStates, ...newStates};
    updateAllStatusUI();
}

function updateAllStatusUI() {
    updateLampuStatus(deviceStates.lampu ? "ON" : "OFF");
    updateFanStatus(deviceStates.kipas ? "ON" : "OFF");
    updateKranStatus(deviceStates.kran ? "TERBUKA" : "TERTUTUP");
    toggleKontrolAktif(currentMode === 'manual');
}

function toggleKontrolAktif(isManual) {
    const imgs = document.querySelectorAll('img[onclick^="toggleDevice"]');
    imgs.forEach(img => {
        img.style.pointerEvents = isManual ? 'auto' : 'none';
        img.style.opacity = isManual ? '1' : '0.5';
    });
    const buttons = document.querySelectorAll('button');
    buttons.forEach(btn => {
        btn.disabled = !isManual;
        btn.style.opacity = isManual ? '1' : '0.5';
    });
}

function toggleDevice(device) {
    if (currentMode !== 'manual') {
        alert('Mode otomatis aktif. Tidak bisa mengontrol perangkat secara manual.');
        return;
    }

    if (!deviceStates.hasOwnProperty(device)) {
        console.error('Device tidak valid:', device);
        return;
    }

    const newStatus = !deviceStates[device];

    fetch("/api/device/update", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
        },
        body: JSON.stringify({
            device: device,
            status: newStatus
        })
    })
    .then(response => response.json())
    .then(data => {
        if(data.status) {
            deviceStates[device] = newStatus;
            switch (device) {
                case "lampu":
                    updateLampuStatus(newStatus ? "ON" : "OFF");
                    break;
                case "kipas":
                    updateFanStatus(newStatus ? "ON" : "OFF");
                    break;
                case "kran":
                    updateKranStatus(newStatus ? "TERBUKA" : "TERTUTUP");
                    break;
            }
        } else {
            alert(data.message || 'Gagal update status perangkat');
        }
    })
    .catch(error => console.error("Error:", error));
}

function updateLampuStatus(status) {
    const img = document.getElementById("lampu-gambar");
    const text = document.getElementById("lampu-status");
    img.src = status === "ON" ? "/images/light_on.png" : "/images/light_off.png";
    text.innerText = status;
}

function updateFanStatus(status) {
    const img = document.getElementById("fan-gambar");
    const text = document.getElementById("fan-status");
    img.src = status === "ON" ? "/images/fan_on.png" : "/images/fan_off.png";
    text.innerText = status;
}

function updateKranStatus(status) {
    const img = document.getElementById("kran-gambar");
    const text = document.getElementById("kran-status");
    img.src = status === "TERBUKA" ? "/images/water_on.png" : "/images/water_off.png";
    text.innerText = status;
}

function gerakMotor(arah) {
    if (currentMode !== 'manual') {
        alert('Mode otomatis aktif. Tidak bisa mengontrol motor secara manual.');
        return;
    }
    fetch(`/api/motor/gerak/${arah}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        }
    })
    .then(res => {
        if (!res.ok) throw new Error("Gagal kirim perintah");
        return res.json();
    })
    .then(data => {
        console.log(data);
        // Opsional: update status arah motor di UI jika kamu punya elemen khusus
        const motorStatusEl = document.getElementById("motor-status");
        if (motorStatusEl) {
            motorStatusEl.textContent = `Motor arah: ${arah.toUpperCase()}`;
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Terjadi kesalahan saat mengirim perintah.");
    });
}

// Fungsi untuk set mode dari luar (misal dari dropdown)
function setMode(mode) {
    currentMode = mode;
    toggleKontrolAktif(mode === 'manual');
}

// Fungsi ubahMode yang mengirim update mode ke backend dan update UI
function ubahMode(mode) {
    fetch('/api/device/mode', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
        },
        body: JSON.stringify({ mode: mode })
    })
    .then(async response => {
        if (!response.ok) {
            const err = await response.json();
            alert('Gagal ubah mode: ' + (err.message || 'Error server'));
            return;
        }
        const data = await response.json();
        setMode(mode);
        console.log('Mode berhasil diubah:', data);
    })
    .catch(error => {
        alert('Error jaringan: ' + error.message);
    });
}
