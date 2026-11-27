<nav class="navbar navbar-expand-lg navbar-dark navbar-helpdesk">
    <div class="container">
        <a class="navbar-brand" href="{{ route('aset.index') }}">IT Helpdesk System</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHelpdesk"
            aria-controls="navbarHelpdesk" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarHelpdesk">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                <li class="nav-item">
                    <a @class(['nav-link', 'active' => request()->routeIs('departemen.*')])
                        href="{{ route('departemen.index') }}">Departemen</a>
                </li>
                <li class="nav-item">
                    <a @class(['nav-link', 'active' => request()->routeIs('aset.*')])
                        href="{{ route('aset.index') }}">Aset PC</a>
                </li>

                @auth
                    <li class="nav-item d-flex align-items-center ms-lg-2">
                        <span class="badge-role me-2">{{ Auth::user()->role }}</span>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline m-0">
                            @csrf
                            <button type="submit" class="nav-link btn-logout">
                                Logout ({{ Auth::user()->username }})
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => request()->routeIs('login')])
                            href="{{ route('login') }}">Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
