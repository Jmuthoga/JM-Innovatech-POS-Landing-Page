<style>
:root {
    --jpos-blue: #0b4fa3;
    --jpos-blue-light: #0b4fa3;
    --jpos-green: #2e7d32;
    --jpos-green-light: #4caf50;
}

.sidebar {
    width: 280px;
    min-height: 100vh;
    background: var(--jpos-blue);
    color: #fff;
    padding: 1rem;
}

.sidebar .user-panel {
    border-bottom: 1px solid rgba(255,255,255,0.15);
}

.sidebar .nav-link {
    color: rgba(255,255,255,0.85);
    border-radius: 10px;
    padding: 12px 15px;
    transition: all .3s ease;
}

.sidebar .nav-link:hover,
.sidebar .nav-link.active {
    background: rgba(255,255,255,0.15);
    color: #fff;
}

.sidebar .nav-link i {
    width: 22px;
}

.sidebar-help-card .card {
    border-radius: 14px;
}

.sidebar-help-card .btn-success {
    background: var(--jpos-green);
    border-color: var(--jpos-green);
}

.sidebar-help-card .btn-success:hover {
    background: var(--jpos-green-light);
    border-color: var(--jpos-green-light);
}

.sidebar-help-card .btn-outline-success {
    color: var(--jpos-green);
    border-color: var(--jpos-green);
}

.sidebar-help-card .btn-outline-success:hover {
    background: var(--jpos-green);
    border-color: var(--jpos-green);
}
</style>

<div class="sidebar d-flex flex-column">

    <!-- User Panel -->
    <div class="user-panel d-flex align-items-center pb-3 mb-3">

        <div class="ms-3">
            <a href="#"
               class="text-decoration-none text-white fw-bold">
                {{ auth()->user()->name }}
            </a>
        </div>

    </div>

    <!-- Navigation -->
    <nav class="flex-grow-1">
        <ul class="nav flex-column gap-2">

            <li class="nav-item">
                <a href="" class="nav-link active">
                    <i class="fas fa-tachometer-alt me-2"></i>
                    Dashboard
                </a>
            </li>

        </ul>
    </nav>

    <!-- Help Card -->
    <div class="sidebar-help-card mt-auto pt-4">
        <div class="card shadow-sm border-0 bg-white">
            <div class="card-body text-center">

                <h6 class="fw-semibold text-dark mb-1">
                    Need Help?
                </h6>

                <p class="text-muted small mb-3">
                    Our support team is available
                </p>

                <div class="d-flex justify-content-center gap-2">

                    <a href="tel:0791446968"
                       class="btn btn-outline-success btn-sm d-flex align-items-center">
                        <i class="fas fa-phone-alt me-1"></i>
                        Call
                    </a>

                    <a href="https://wa.me/254791446968"
                       target="_blank"
                       class="btn btn-success btn-sm d-flex align-items-center">
                        <i class="fab fa-whatsapp me-1"></i>
                        WhatsApp
                    </a>

                </div>

                <hr>

                <small class="text-muted">
                    Support:
                    <strong>+254791446968</strong>
                </small>

            </div>
        </div>
    </div>

</div>