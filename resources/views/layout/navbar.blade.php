<nav class="header-navbar navbar-expand-lg navbar navbar-fixed navbar-shadow navbar-brand-center" data-nav="brand-center">
    <div class="d-xl-block d-none">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <h2 class="brand-text mb-0" style="color: #7367F0;padding-left: 1rem;font-weight: 600;letter-spacing: .01rem;font-size: 1.45rem;animation: .3s">{{ config('app.name') }} </h2>
                </a>
            </li>
        </ul>
    </div>
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
            </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ml-auto">

            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="user-nav d-sm-flex d-none">
                    <span class="user-name font-weight-bolder">{{ auth()->user()->prenom." ".auth()->user()->nom}}</span>
                    <span class="user-status">{{ (Str::upper(auth()->user()->profil))}}</span>
                </div>
                <span class="avatar">

                    @if(json_decode(auth()->user()->photo) != "")
                        <img src="{{ url('uploads/user/photo/'.json_decode(auth()->user()->photo)) }}" class="round" alt="Photo" height="40" width="40" />
                    @else
                        <img src="{{ url('app-assets/images/avatars/profil.jpg')}}" class="round" alt="avatar" height="40" width="40" />
                    @endif
                    <span class="avatar-status-online"></span>
                </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                <a class="dropdown-item" href="{{ route('user.compte') }}"><i class="mr-50" data-feather="user"></i> Mon compte</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('deconnexion') }}"><i class="mr-50" data-feather="power"></i> Déconnexion</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
