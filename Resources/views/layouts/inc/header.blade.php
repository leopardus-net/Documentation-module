<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ url('/') }}">
                <!-- Logo icon -->
                <b>
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img style="max-width: 48px;" src="{{ asset( $settings->logo_icon ? $settings->logo_icon : 'assets/images/logo-icon.png') }}" alt="homepage" class="dark-logo" />
                    <!-- Light Logo icon -->
                    <img style="max-width: 48px;" src="{{ asset( $settings->logo_icon ? $settings->logo_icon : 'assets/images/logo-icon.png') }}" alt="homepage" class="light-logo" />
                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span>
                    <!-- dark Logo text -->
                    <img src="{{ asset( $settings->logo_text ? $settings->logo_text : 'assets/images/logo-text.png') }}" alt="homepage" class="dark-logo" />
                    <!-- Light Logo text -->    
                    <img src="{{ asset( $settings->logo_text ? $settings->logo_text : 'assets/images/logo-light-text.png') }}" class="light-logo" alt="homepage" />
                </span>
            </a>
        </div>
       
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav mr-auto mt-md-0">
                <!-- This is  -->
                <li class="nav-item">
                    <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a>
                </li>
                <li class="nav-item d-block d-sm-none">
                    <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link waves-effect waves-dark" href="{{ url('/') }}">Home</a>
                </li>
            </ul>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <ul class="navbar-nav my-lg-0">
                <!-- ============================================================== -->
                <!-- Language -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                        @if($currentLang->icon) 
                            <i class="{{ $currentLang->icon }}"></i>
                        @else 
                            <i class="flag-icon flag-icon-{{ $currentLang->iso }}"></i>
                        @endif
                    </a>

                    <div class="dropdown-menu dropdown-menu-right scale-up">
                        @foreach( $languajes as $lang ) 
                            <a class="dropdown-item" href="{{ url("docs/$currentVersion/$lang->iso") }}">
                                @if($lang->icon) 
                                    <i class="{{ $lang->icon }}"></i> 
                                @else 
                                    <i class="flag-icon flag-icon-{{ $lang->iso }}"></i> 
                                @endif

                                @lang("languaje-list.$lang->slug")
                            </a>
                        @endforeach
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>