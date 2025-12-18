@extends('layouts.guest')

@section('title', 'UMKM - Identitas Pengembang')

@section('content')
    <!-- Developer Profile Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-5">
                <!-- Developer Information -->
                <div class="col-lg-8">
                    <div class="bg-light rounded p-5 mb-5 shadow-lg">
                        <h1 class="mb-4">Identitas Pengembang</h1>
                        <p class="mb-4">Berikut adalah informasi mengenai pengembang platform UMKM  yang bertanggung jawab dalam pembuatan dan pengembangan sistem ini.</p>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-4 p-3 rounded shadow-sm bg-white">
                                    <div class="bg-primary rounded-circle p-3 me-3 shadow">
                                        <i class="fas fa-user fa-2x text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0">Nama Lengkap</h5>
                                        <p class="mb-0 text-primary fs-5">M.Rafif Zidane</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-4 p-3 rounded shadow-sm bg-white">
                                    <div class="bg-secondary rounded-circle p-3 me-3 shadow">
                                        <i class="fas fa-id-card fa-2x text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0">NIM</h5>
                                        <p class="mb-0 text-secondary fs-5">2457301082</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-4 p-3 rounded shadow-sm bg-white">
                                    <div class="bg-primary rounded-circle p-3 me-3 shadow">
                                        <i class="fas fa-graduation-cap fa-2x text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0">Program Studi</h5>
                                        <p class="mb-0 text-primary fs-5">Sistem Informasi</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-4 p-3 rounded shadow-sm bg-white">
                                    <div class="bg-secondary rounded-circle p-3 me-3 shadow">
                                        <i class="fas fa-university fa-2x text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0">Perguruan Tinggi</h5>
                                        <p class="mb-0 text-secondary fs-5">Polteknik Caltex Riau</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-4 p-3 rounded shadow-sm bg-white">
                                    <div class="bg-primary rounded-circle p-3 me-3 shadow">
                                        <i class="fas fa-envelope fa-2x text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0">Email</h5>
                                        <p class="mb-0 text-primary">m.rafif24si@mahasiswa.pcr.ac.id</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-4 p-3 rounded shadow-sm bg-white">
                                    <div class="bg-secondary rounded-circle p-3 me-3 shadow">
                                        <i class="fas fa-phone fa-2x text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0">Telepon</h5>
                                        <p class="mb-0 text-secondary">+62 852 1061 1777</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Skills & Expertise -->
                    <div class="bg-light rounded p-5 mb-5 shadow-lg">
                        <h3 class="mb-4">Keahlian Teknis</h3>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="skill-item p-4 rounded shadow-sm bg-white">
                                    <h6>Frontend Development</h6>
                                    <div class="progress mb-3 shadow-sm">
                                        <div class="progress-bar bg-primary" style="width: 90%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="skill-item p-4 rounded shadow-sm bg-white">
                                    <h6>Backend Development</h6>
                                    <div class="progress mb-3 shadow-sm">
                                        <div class="progress-bar bg-secondary" style="width: 85%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="skill-item p-4 rounded shadow-sm bg-white">
                                    <h6>Database Management</h6>
                                    <div class="progress mb-3 shadow-sm">
                                        <div class="progress-bar bg-primary" style="width: 80%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="skill-item p-4 rounded shadow-sm bg-white">
                                    <h6>UI/UX Design</h6>
                                    <div class="progress mb-3 shadow-sm">
                                        <div class="progress-bar bg-secondary" style="width: 75%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- About Developer -->
                    <div class="bg-light rounded p-5 shadow-lg">
                        <h3 class="mb-4">Tentang Saya</h3>
                        <p class="mb-3">Saya adalah seorang pengembang web yang memiliki passion dalam menciptakan solusi digital untuk membantu UMKM Indonesia berkembang di era digital.</p>
                        <p class="mb-3">Platform UMKM  ini dikembangkan sebagai wujud kontribusi nyata dalam memberdayakan pelaku usaha kecil dan menengah melalui teknologi.</p>
                        <p class="mb-0">Dengan latar belakang pendidikan di bidang teknologi informasi, saya berkomitmen untuk terus mengembangkan platform ini agar dapat memberikan manfaat yang lebih besar bagi masyarakat.</p>
                    </div>
                </div>

                <!-- Developer Photo & Social Media -->
                <div class="col-lg-4">
                    <div class="bg-light rounded p-5 mb-5 text-center shadow-lg">
                        <div class="developer-photo mb-4">
                            <img src="{{ asset('assets-guest/img/potoprofil.jpg') }}" class="img-fluid rounded-circle border border-5 border-primary shadow" alt="Developer Photo" style="width: 250px; height: 250px; object-fit: cover;">
                        </div>
                        <h3 class="mb-3">M.Rafif Zidane</h3>
                        <p class="text-muted mb-4">Full Stack Developer & Founder UMKM </p>

                        <!-- Social Media Links -->
                        <div class="social-links mb-4">
                            <h5 class="mb-3">Hubungi Saya</h5>
                            <div class="d-flex justify-content-center">
                                <a href="https://linkedin.com/in/rafifzidane" class="btn btn-primary btn-square me-2 shadow" title="LinkedIn">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="https://github.com/mrafif24si-lab/UMKM-guest.git" class="btn btn-secondary btn-square me-2 shadow" title="GitHub">
                                    <i class="fab fa-github"></i>
                                </a>
                                <a href="https://instagram.com/raffzdne" class="btn btn-primary btn-square me-2 shadow" title="Instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>
                          
                                <a href="#" class="btn btn-primary btn-square shadow" title="Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </div>
                        </div>

                        <div class="contact-info">
                            <div class="d-flex align-items-center justify-content-center mb-3 p-3 rounded shadow-sm bg-white">
                                <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                <span>Jl.Paus</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-3 p-3 rounded shadow-sm bg-white">
                                <i class="fas fa-globe text-primary me-2"></i>
                                <a href="https://yourportfolio.com" class="text-decoration-none">https://yourportfolio.com</a>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="bg-light rounded p-5 shadow-lg">
                        <h4 class="mb-4">Link Cepat</h4>
                        <div class="d-flex flex-column">
                            <a href="#" class="btn btn-outline-secondary mb-3 shadow-sm">
                                <i class="fas fa-project-diagram me-2"></i> Proyek Lainnya
                            </a>
                            <a href="#" class="btn btn-outline-primary mb-3 shadow-sm">
                                <i class="fas fa-file-download me-2"></i> Download CV
                            </a>
                            <a href="mailto:[email@example.com]" class="btn btn-outline-secondary shadow-sm">
                                <i class="fas fa-paper-plane me-2"></i> Kirim Email
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Developer Profile End -->
@endsection

@section('styles')
<style>
    .btn-square {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .btn-square:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2) !important;
    }

    .developer-photo {
        position: relative;
    }

    .developer-photo::after {
        content: '';
        position: absolute;
        width: 260px;
        height: 260px;
        border: 3px dashed var(--primary);
        border-radius: 50%;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: -1;
    }

    .skill-item h6 {
        margin-bottom: 8px;
        font-weight: 600;
    }

    .progress {
        height: 10px;
        border-radius: 5px;
    }

    .progress-bar {
        border-radius: 5px;
    }

    /* Additional shadow effects */
    .shadow {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important;
    }

    .shadow-sm {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05) !important;
    }

    .shadow-lg {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
        transition: all 0.3s ease;
    }

    .shadow-lg:hover {
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2) !important;
    }

    /* Hover effects for info items */
    .d-flex.align-items-center.mb-4.p-3.rounded.shadow-sm.bg-white {
        transition: all 0.3s ease;
    }

    .d-flex.align-items-center.mb-4.p-3.rounded.shadow-sm.bg-white:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1) !important;
    }

    /* Button hover effects */
    .btn-outline-primary, .btn-outline-secondary {
        transition: all 0.3s ease;
    }

    .btn-outline-primary:hover, .btn-outline-secondary:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
    }

    /* Social media button hover */
    .btn-square.shadow:hover {
        transform: translateY(-5px) scale(1.1);
    }
</style>
@endsection
