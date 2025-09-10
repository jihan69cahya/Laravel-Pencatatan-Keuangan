<header id="page-header">
    <div class="content-header">
        <div>
            <button type="button" class="btn btn-alt-secondary me-1" data-toggle="layout" data-action="sidebar_toggle">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>
        <div>
            <div class="dropdown d-inline-block">
                <button type="button" class="btn btn-alt-secondary" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-user d-sm-none"></i>
                    <span class="d-none d-sm-inline-block">{{ Auth::user()->role }}</span>
                    <i class="fa fa-fw fa-angle-down opacity-50 ms-1 d-none d-sm-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end p-0" aria-labelledby="page-header-user-dropdown">
                    <div class="bg-primary-dark rounded-top fw-semibold text-white text-center p-3">
                        {{ Auth::user()->name }}
                    </div>
                    <div class="p-2">
                        <a class="dropdown-item" href="javascript:void(0)">
                            <i class="far fa-fw fa-user me-1"></i> Profile
                        </a>

                        <div role="separator" class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void(0)" onclick="confirm_logout()">
                            <i class="far fa-fw fa-arrow-alt-circle-left me-1"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="page-header-loader" class="overlay-header bg-primary-darker">
        <div class="content-header">
            <div class="w-100 text-center">
                <i class="fa fa-fw fa-2x fa-sun fa-spin text-white"></i>
            </div>
        </div>
    </div>
</header>
