<nav class="navbar navbar-expand navbar-light bg-white px-4 border-bottom shadow-sm">
    <div class="container-fluid p-0">
        <span class="navbar-brand fw-semibold text-secondary">Control Hub</span>

        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav align-items-center gap-3">
                <li class="nav-item text-end d-none d-sm-block">
                    <small class="text-muted d-block text-uppercase" style="font-size: 0.75rem;">System Operator</small>
                    <span class="fw-bold text-dark">{{ auth('admin')->user()->name ?? 'Administrator' }}</span>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link p-0" href="#" id="adminProfile" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" 
                             style="width: 40px; height: 40px; background-color: var(--jpos-blue);">
                            {{ strtoupper(substr(auth('admin')->user()->name ?? 'A', 0, 1)) }}
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 rounded-3" aria-labelledby="adminProfile">
                        <li><a class="dropdown-menu-item p-2.5 px-3 dropdown-item" href="#"><i class="bi bi-gear me-2 text-muted"></i> System Prefs</a></li>
                        <li><hr class="dropdown-divider m-0"></li>
                        <li>
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item p-2.5 px-3 text-danger"><i class="bi bi-power me-2"></i> Terminate Session</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>