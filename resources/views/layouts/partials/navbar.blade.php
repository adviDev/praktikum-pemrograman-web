<nav class="navbar navbar-dark bg-danger sticky-top shadow-sm">
    <div class="container-fluid">
        <div class="d-flex align-self-center">
            <button class="navbar-toggler d-lg-none me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-label="Buka menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a href="{{ route('dashboard') }}" class="navbar-brand fw-semibold">
                <i class="bi bi-mortarboard-fill me-1"></i>
                {{ config('app.name') }}
            </a>
        </div>

        <div class="d-flex align-items-center">
            <button class="btn btn-outline-light me-2" type="button" id="btnThemeToggle" title="Ganti Tema">
                <i class="bi bi-moon-fill" id="themeIcon"></i>
            </button>
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle"></i>
                    <span class="d-none d-sm-inline">{{ Auth::user()->name }}</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <span class="dropdown-item-text small">
                            {{ Auth::user()->email }}
                            <span class="badge text-bg-secondary ms-1">{{ Auth::user()->role }}</span>
                        </span>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="dropdown-item text-danger" type="submit">
                                <i class="bi bi-box-arrow-right me-1"></i> Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
@push('script')
<script>
    const htmlElement = document.documentElement;
    const btnToggle = document.getElementById('btnThemeToggle');
    const themeIcon = document.getElementById('themeIcon');

    const savedTheme = localStorage.getItem('theme') || 'light';
    htmlElement.setAttribute('data-bs-theme', savedTheme);
    updateIcon(savedTheme);

    btnToggle.addEventListener('click', function () {
        const currentTheme = htmlElement.getAttribute('data-bs-theme') || 'light';
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

        htmlElement.setAttribute('data-bs-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        updateIcon(newTheme);
    });

    function updateIcon(theme) {
        if (theme === 'dark') {
            themeIcon.classList.replace('bi-moon-fill', 'bi-sun-fill');
        } else {
            themeIcon.classList.replace('bi-sun-fill', 'bi-moon-fill');
        }
    }
</script>
@endpush
