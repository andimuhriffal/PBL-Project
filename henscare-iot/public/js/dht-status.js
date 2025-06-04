document.addEventListener('DOMContentLoaded', function () {
    const img = document.getElementById('dht-status-img');
    const icon = document.getElementById('dht-status-icon');

    function updateDHTStatus() {
        fetch('/api/get-iot')
            .then(response => response.json())
            .then(data => {
                let status = data.status_sensor;
                let imgPath = '';
                let iconClass = '';

                if (status === 'AKTIF') {
                    imgPath = '/images/sensors/dht-on.png';
                    iconClass = 'bi-heart-pulse-fill text-success';
                } else if (status === 'GANGGUAN') {
                    imgPath = '/images/sensors/dht-unstable.png';
                    iconClass = 'bi-exclamation-triangle-fill text-warning';
                } else if (status === 'MATI') {
                    imgPath = '/images/sensors/dht-off.png';
                    iconClass = 'bi-x-circle-fill text-danger';
                } else {
                    imgPath = '/images/sensors/dht-off.png';
                    iconClass = 'bi-question-circle-fill text-secondary';
                }

                img.src = imgPath;
                icon.className = `bi fs-2 ${iconClass}`;
            })
            .catch(err => {
                console.error('Gagal ambil data DHT:', err);
            });
    }

    updateDHTStatus();
    setInterval(updateDHTStatus, 3000);
});
