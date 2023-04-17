<ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
    <!-- Accueil --------------------------------------------------------------------------------------------------->
    <li class="dropdown nav-item {{ (request()->is('dashboard')) ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center" href="{{ route('dashboard') }}" >
            <i data-feather="activity"></i>
            <span>Tableau de Board</span>
        </a>
    </li>
    <!-- END --------------------------------------------------------------------------------------------------->
    <!-- Agence --------------------------------------------------------------------------------------------------->
    <li class="dropdown nav-item {{ (request()->is('agence*')) ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center" href="{{ route('agence.index') }}" >
            <i class="fa fa-home"></i>
            <span>Agence</span>
        </a>
    </li>
    <!-- END --------------------------------------------------------------------------------------------------->

    <!-- Compagnie --------------------------------------------------------------------------------------------------->
    <li class="dropdown nav-item {{ (request()->is('compagnie*')) ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center" href="{{ route('compagnie.index') }}" >
            <i class="fa fa-building"></i>
            <span>Compagnie</span>
        </a>
    </li>
    <!-- END --------------------------------------------------------------------------------------------------->
    <!-- Feuille de soins --------------------------------------------------------------------------------------------------->
    <li class="dropdown nav-item {{ (request()->is('feuille*')) ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center" href="{{ route('feuille.index') }}" >
            <i class="fa fa-file-text-o"></i>

            <span>Feuille de soins</span>
        </a>
    </li>
    <!-- END --------------------------------------------------------------------------------------------------->

    <!-- Prestataire --------------------------------------------------------------------------------------------------->
    <li class="dropdown nav-item" data-menu="dropdown">
        <a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown">
            <i class="fa fa-user-md"></i>
            <span data-i18n="Menu 1">Médécin</span>
        </a>
        <ul class="dropdown-menu">
            <li data-menu="" class="{{ (request()->is('listmedecin*') || request()->is('medecin/*')) ? 'active' : '' }}">
                <a class="dropdown-item d-flex align-items-center" href="{{ route('medecin.index') }}" data-toggle="dropdown" data-i18n="Liste">
                    <i data-feather="list"></i>
                    <span data-i18n="Liste">Liste des médécins</span>
                </a>
            </li>
             <li data-menu="" class="{{ (request()->is('medecin')) ? 'active' : '' }}">
                <a class="dropdown-item d-flex align-items-center" href="{{ route('medecin.create') }}" data-toggle="dropdown" data-i18n="Liste">
                    <i data-feather="plus"></i>
                    <span data-i18n="Liste">Créer un médécin</span>
                </a>
            </li>
            <li data-menu="" class="{{ (request()->is('medecin_specialite*')) ? 'active' : '' }}">
                <a class="dropdown-item d-flex align-items-center" href="{{ route('medecin_specialite.index') }}" data-toggle="dropdown" data-i18n="Nouvelle">
                   <i class="fa fa-th-large" aria-hidden="true"></i>
                    <span data-i18n="Nouvelle">Gestion Spécialité</span>
                </a>
            </li>

            <li data-menu="" class="{{ (request()->is('constante*')) ? 'active' : '' }}">
                <a class="dropdown-item d-flex align-items-center" href="{{ route('constante.index') }}" data-toggle="dropdown" data-i18n="Nouvelle">
                   <i class="fa fa-th-large" aria-hidden="true"></i>
                    <span data-i18n="Nouvelle">Gestion Constante</span>
                </a>
            </li>

        </ul>
    </li>
    <!-- END --------------------------------------------------------------------------------------------------->


    <!-- Prestataire --------------------------------------------------------------------------------------------------->

    <li class="dropdown nav-item {{ (request()->is('prestataire*')) ? 'active' : '' }}" data-menu="dropdown">
        <a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown">
            <i data-feather="users"></i>
            <span data-i18n="Menu 1">Prestataire</span>
        </a>
        <ul class="dropdown-menu">
            <li data-menu="" class="{{ (request()->is('prestataire.index')) ? 'active' : '' }}">
                <a class="dropdown-item d-flex align-items-center" href="{{ route('prestataire.index') }}" data-toggle="dropdown" data-i18n="Liste">
                    <i data-feather="list"></i>
                    <span data-i18n="Liste">Liste</span>
                </a>
            </li>

            <li data-menu="" class="{{ (request()->is('prestataire.createOrUpdate')) ? 'active' : '' }}">
                <a class="dropdown-item d-flex align-items-center" href="{{ route('prestataire.createOrUpdate') }}" data-toggle="dropdown" data-i18n="Nouvelle">
                    <i data-feather="plus"></i>
                    <span data-i18n="Nouvelle">Créer</span>
                </a>
            </li>

        </ul>
    </li>
    <!-- END --------------------------------------------------------------------------------------------------->

    <!-- Prestation --------------------------------------------------------------------------------------------------->
    <li class="dropdown nav-item {{ (request()->is('prestation*')) ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center" href="{{ route('prestation.index') }}" >
            <i data-feather="command"></i>
            <span>Prestation</span>
        </a>
    </li>
    <!-- END --------------------------------------------------------------------------------------------------->

    <!-- Utilisateur --------------------------------------------------------------------------------------------------->
    <li class="dropdown nav-item" data-menu="dropdown">
        <a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown">
            <i data-feather="users"></i>
            <span data-i18n="Menu 1">Utilisateur</span>
        </a>
        <ul class="dropdown-menu">
            <li data-menu="" class="{{ (request()->is('listuser*')) ? 'active' : '' }}">
                <a class="dropdown-item d-flex align-items-center" href="{{ route('user.index') }}" data-toggle="dropdown" data-i18n="Liste">
                    <i data-feather="list"></i>
                    <span data-i18n="Liste">Liste</span>
                </a>
            </li>

            <li data-menu="" class="{{ (request()->is('user*')) ? 'active' : '' }}">
                <a class="dropdown-item d-flex align-items-center" href="{{ route('user.create') }}" data-toggle="dropdown" data-i18n="Nouvelle">
                    <i data-feather="plus"></i>
                    <span data-i18n="Nouvelle">Créer</span>
                </a>
            </li>

        </ul>
    </li>
    <!-- END --------------------------------------------------------------------------------------------------->



    <!-- Parametre --------------------------------------------------------------------------------------------------->
    {{-- <li class="dropdown nav-item" data-menu="dropdown">
        <a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown">
            <i data-feather="credit-card"></i>
            <span data-i18n="Menu 1">Menu 1</span>
        </a>
        <ul class="dropdown-menu">
            <li data-menu="" class="{{ (request()->is('menu*')) ? 'active' : '' }}">
                <a class="dropdown-item d-flex align-items-center" href="" data-toggle="dropdown" data-i18n="Liste">
                    <i data-feather="circle"></i>
                    <span data-i18n="Liste">Sous Menu 1</span>
                </a>
            </li>

            <li data-menu="" class="{{ (request()->is('carte-grise.create')) ? 'active' : '' }}">
                <a class="dropdown-item d-flex align-items-center" href="#" data-toggle="dropdown" data-i18n="Nouvelle">
                    <i data-feather="circle"></i>
                    <span data-i18n="Nouvelle">Sous Menu 2</span>
                </a>
            </li>


            <li data-menu="" class="{{ (request()->is('menu.rapport')) ? 'active' : '' }}">
                <a class="dropdown-item d-flex align-items-center" href="#" data-toggle="dropdown" data-i18n="Nouvelle">
                    <i data-feather="circle"></i>
                    <span data-i18n="Nouvelle">Sous menu 3</span>
                </a>
            </li>


            <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu">
                <a class="dropdown-item d-flex align-items-center dropdown-toggle" href="#" data-toggle="dropdown" data-i18n="Paramètres">
                    <i data-feather="circle"></i>
                    <span data-i18n="Paramètres">Paramètres</span>
                </a>
                <ul class="dropdown-menu">
                    <li data-menu="" class="{{ (request()->is('carrosserie*')) ? 'active' : '' }}">
                        <a class="dropdown-item d-flex align-items-center" href="#" data-toggle="dropdown" data-i18n="Raise Support"><i data-feather="circle"></i><span data-i18n="circle">Sous Sous menu 1</span></a>
                    </li>
                    <li data-menu="" class="{{ (request()->is('commune*')) ? 'active' : '' }}">
                        <a class="dropdown-item d-flex align-items-center" href="#" data-toggle="dropdown" data-i18n="Raise Support"><i data-feather="circle"></i><span data-i18n="circle">Sous Sous menu 2</span></a>
                    </li>

                </ul>
            </li>

        </ul>
    </li> --}}
    <!-- END --------------------------------------------------------------------------------------------------->
    <!-- NEW Menu --------------------------------------------------------------------------------------------------->

    <!-- END --------------------------------------------------------------------------------------------------->

</ul>
