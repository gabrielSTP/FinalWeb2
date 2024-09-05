<nav class="container-fluid navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <!-- Dropdown para Livros -->
                <li class="dropdown @if (str_contains(Route::current()->getName(), 'products')) active @endif">
                    <a class="nav-link dropdown-toggle" href={{ route('products.index') }} id="navbarDropdown"
                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Livros
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href={{ route('products.index') }}>Listar Todos</a>
                        <a class="dropdown-item" href={{ route('products.create') }}>Cadastrar</a>
                    </div>
                </li>

                <!-- Dropdown para Gêneros (somente para Administradores) -->
                @if(Auth::user()->hasRole('Administrator'))
                    <li class="dropdown @if (str_contains(Route::current()->getName(), 'category')) active @endif">
                        <a class="nav-link dropdown-toggle" href={{ route('category.index') }} id="navbarDropdown"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Gêneros
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href={{ route('category.index') }}>Listar Todos</a>
                            <a class="dropdown-item" href={{ route('category.create') }}>Cadastrar</a>
                        </div>
                    </li>
                @endif
            </ul>

            <!-- Botões sem verificação de auth (visíveis para Administradores) -->
            <div class="d-flex">
                <!-- Botão para acessar o controle de produtos -->
                <a href="{{ route('dashboard') }}" class="btn btn-success mr-2">
                    Acessar Dashboard
                </a>

                <!-- Botão para ver o catálogo -->
                <a href="{{ route('catalogo') }}" class="btn btn-primary mr-2">
                    Ver Catálogo
                </a>
            </div>

            <!-- Dropdown de perfil do usuário -->
            <div class="">
                <ul class="navbar-nav ml-auto">
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href={{ route('profile.edit') }}> {{ __('Profile') }}</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" href={{ route('logout') }}
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('LogOut') }}
                                </a>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
