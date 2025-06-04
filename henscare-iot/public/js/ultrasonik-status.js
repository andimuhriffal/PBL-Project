document.addEventListener('DOMContentLoaded', function () {
    function updateUltrasonikSensorStatus() {
        fetch('/api/get-iot')
            .then(response => response.json())
            .then(data => {
                const status = data.status_sensor_ultrasonik;
                const img = document.getElementById('ultrasonik-status-img');
                const icon = document.getElementById('ultrasonik-status-icon');

                let imgPath = '';
                let iconClass = '';

                if (status === 'NORMAL') {
                    imgPath = '/images/sensors/ultrasonik-on.png';
                    iconClass = 'bi-check-circle-fill text-success';
                } else if (status === 'TIDAK_STABIL') {
                    imgPath = '/images/sensors/ultrasonik-unstable.png';
                    iconClass = 'bi-exclamation-triangle-fill text-warning';
                } else if (status === 'MATI') {
                    imgPath = '/images/sensors/ultrasonik-off.png';
                    iconClass = 'bi-x-circle-fill text-danger';
                } else {
                    imgPath = '/images/sensors/ultrasonik-off.png';
                    iconClass = 'bi-question-circle-fill text-secondary';
                }

                img.src = imgPath;
                icon.className = `bi fs-2 ${iconClass}`;
            })
            .catch(err => {
                console.error('Gagal ambil data sensor ultrasonik:', err);
            });
    }

    updateUltrasonikSensorStatus();
    setInterval(updateUltrasonikSensorStatus, 3000);
});
