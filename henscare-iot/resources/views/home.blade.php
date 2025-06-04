@extends('layouts.app-home')

@section('title', 'Dashboard IoT')

@section('content')

<div class="boody">
    <section class="hero-section">
        <div class="hero-content">
            <h1>HENS CARE</h1>
            <div class="hero-subtitle">Sistem Monitoring Pakan Ayam Cerdas Berbasis IoT</div>
        </div>
    </section>

    <!-- Description and Buttons Section -->
    <section class="description-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <p class="description-text"> Perawatan ayam bertelur kini semakin efisien dengan penerapan teknologi
                        IoT, yang memungkinkan pemantauan suhu kandang, kelembapan, pemberian pakan, serta pendeteksian
                        kualitas udara secara real-time melalui sensor dan sistem otomatis, sehingga kesehatan ayam dan
                        produktivitas telur dapat terjaga secara optimal.

                    </p>

                    <!-- <div class="action-buttons">
                        <a href="/dashboard" class="btn btn-action btn-primary-action">
                            <i class="bi bi-speedometer2 me-2"></i>Dashboard
                        </a>
                        <a href="{{ route('tabel.pakan') }}" class="btn btn-action btn-secondary-action">
                            <i class="bi bi-clock-history me-2"></i>Riwayat Pemantauan
                        </a>
                    </div> -->
                </div>
            </div>
        </div>
    </section>

    <!-- Problems Section -->
    <section class="section bg-pattern">
        <div class="container">
            <h2 class="section-title">Permasalahan yang Dihadapi</h2>
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="problem-card">
                        <div class="problem-icon">
                            <i class="bi bi-thermometer-sun"></i>
                        </div>
                        <h4>Suhu Kandang Tidak Stabil</h4>
                        <p>Suhu kandang tidak stabil saat cuaca ekstrem, mempengaruhi kesehatan dan produktivitas
                            ayam petelur.</p>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="problem-card">
                        <div class="problem-icon">
                            <i class="bi bi-droplet"></i>
                        </div>
                        <h4>Air Minum Sering Habis</h4>
                        <p>Air minum sering habis tanpa terpantau, menyebabkan dehidrasi dan stress pada ayam.</p>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="problem-card">
                        <div class="problem-icon">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>
                        <h4>Pakan Tidak Terkontrol</h4>
                        <p>Pakan tidak terkontrol mengganggu pola makan ayam dan mempengaruhi kualitas telur yang
                            dihasilkan.</p>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="problem-card">
                        <div class="problem-icon">
                            <i class="bi bi-clock"></i>
                        </div>
                        <h4>Pemantauan Manual</h4>
                        <p>Pemantauan manual menyita waktu dan tenaga, serta rentan terhadap human error dalam
                            pengawasan.</p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="problem-card">
                        <div class="problem-icon">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>
                        <h4>Risiko Kematian Ayam</h4>
                        <p>Risiko kematian ayam karena kebutuhan dasar terlambat terpenuhi, mengakibatkan kerugian
                            ekonomi yang signifikan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Solutions Section -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">Solusi yang Ditawarkan</h2>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="solution-card">
                        <div class="solution-icon">
                            <i class="bi bi-thermometer-half"></i>
                        </div>
                        <h3 class="solution-title">Suhu Otomatis Terkendali</h3>
                        <p>Sistem monitoring dan kontrol suhu otomatis yang menjaga <strong>kondisi ideal
                                kandang</strong> sepanjang waktu dengan sensor IoT yang akurat.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="solution-card">
                        <div class="solution-icon">
                            <i class="bi bi-gear"></i>
                        </div>
                        <h3 class="solution-title">Pakan & Minum Otomatis</h3>
                        <p>Sistem otomatis untuk <strong>pemberian pakan dan air minum</strong> dengan jadwal yang
                            teratur dan porsi yang tepat untuk ayam petelur.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="solution-card">
                        <div class="solution-icon">
                            <i class="bi bi-laptop"></i>
                        </div>
                        <h3 class="solution-title">Monitoring Berbasis Web</h3>
                        <p>Dashboard web yang memungkinkan <strong>pemantauan real-time</strong> kondisi kandang
                            dari mana saja dan kapan saja melalui internet.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="section bg-pattern">
        <div class="container">
            <h2 class="section-title">Hens Care Development Team</h2>
            <div class="row justify-content-center">
                <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                    <div class="team-card">
                        <img src="images/anggota/anip.png" alt="Team Member" class="team-photo">
                        <h4 class="team-name">Hanif Dinata</h4>
                        <p class="team-nim">2301083015</p>
                        <p class="team-role">Project Manager | Frontend Developer</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                    <div class="team-card">
                        <img src="images/anggota/manda.png" alt="Team Member" class="team-photo">
                        <h4 class="team-name">Amanda Fahira Jurica</h4>
                        <p class="team-nim">2301083022</p>
                        <p class="team-role">Backend Developer</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                    <div class="team-card">
                        <img src="images/anggota/afi.png" alt="Team Member" class="team-photo">
                        <h4 class="team-name">Nafilah Az Zahra</h4>
                        <p class="team-nim">2301082016</p>
                        <p class="team-role">Docker Engineer | Server Development</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                    <div class="team-card">
                        <img src="images/anggota/taufik.png" alt="Team Member" class="team-photo">
                        <h4 class="team-name">Taufik Kurrahman</h4>
                        <p class="team-nim">2301082017</p>
                        <p class="team-role">IoT Engineer</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                    <div class="team-card">
                        <img src="images/anggota/hamdi.png " alt="Team Member" class="team-photo">
                        <h4 class="team-name">Hamdi Septiawan</h4>
                        <p class="team-nim">2301081008</p>
                        <p class="team-role">Embedded Programmer</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section contact-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="section-title text-white mb-4">Hubungi Kami</h2>

                    <div class="contact-info mb-4">
                        <div class="email-info mb-4">
                            <div class="contact-icon mb-3">
                                <i class="bi bi-envelope-fill"></i>
                            </div>
                            <h4 class="text-white mb-2">Email Resmi</h4>
                            <a href="mailto:henscarekel1TKB@gmail.com" class="email-link">
                                henscarekel1TKB@gmail.com
                            </a>
                        </div>

                        <div class="instagram-info">
                            <div class="contact-icon mb-4">
                                <i class="bi bi-instagram"></i>
                            </div>
                            <h4 class="text-white mb-4">Follow Tim Kami</h4>
                            <div class="instagram-list">
                                <div class="instagram-item">
                                    <a href="https://www.instagram.com/____hanifdinata?igsh=MXNzZTVkMDNkNG1saA=="
                                        class="instagram-link">
                                        <i class="bi bi-instagram me-2"></i>
                                        <span>___hanifdinata</span>
                                    </a>
                                </div>
                                <div class="instagram-item">
                                    <a href="https://www.instagram.com/manda_fhr?igsh=Y3ZnaTkyNzF0cmps"
                                        class="instagram-link">
                                        <i class="bi bi-instagram me-2"></i>
                                        <span>manda_fhr</span>
                                    </a>
                                </div>
                                <div class="instagram-item">
                                    <a href="https://www.instagram.com/nafazar_?igsh=aWkweG9laDZmZDJn"
                                        class="instagram-link">
                                        <i class="bi bi-instagram me-2"></i>
                                        <span>nafazar</span>
                                    </a>
                                </div>
                                <div class="instagram-item">
                                    <a href="https://www.instagram.com/taufikkurrahman78?igsh=OHl4YTdwOTlnNzhk"
                                        class="instagram-link">
                                        <i class="bi bi-instagram me-2"></i>
                                        <span>taufikkurrahman78</span>
                                    </a>
                                </div>
                                <div class="instagram-item">
                                    <a href="https://www.instagram.com/hmdisptwn?igsh=cGxhaXRraXRid2R1"
                                        class="instagram-link">
                                        <i class="bi bi-instagram me-2"></i>
                                        <span>hmdisptwn</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


@endsection
@section('scripts')
<script src="/js/home.js"></script>
@endsection