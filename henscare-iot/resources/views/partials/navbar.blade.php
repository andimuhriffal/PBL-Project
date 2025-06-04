<nav class="navbar navbar-light fixed-top navbar-light-custom shadow-sm">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <!-- Ubah href jadi /home -->
        <a class="navbar-brand d-flex align-items-center" href="/home">
            <img src="images/ayam3.png" alt="Hens Care" width="130" class="me-2">
        </a>

        <form method="GET" action="{{ route('login') }}">
            <button type="submit" class="btn btn-outline-light d-flex align-items-center">
                <i class="fas fa-sign-in-alt me-2"></i> Login
            </button>
        </form>
    </div>
</nav>