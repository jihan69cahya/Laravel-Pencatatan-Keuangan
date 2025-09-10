<header id="page-header">
    <div class="content-header">
        <div class="d-flex align-items-center">
            <a class="fw-semibold text-dual tracking-wide" href="index.html">
                Pencatatan
                <span class="fw-normal">Keuangan</span>
            </a>
        </div>

        <div>
            <button type="button" class="btn btn-alt-secondary d-lg-none" data-toggle="layout"
                data-action="header_search_on">
                <i class="fa fa-fw fa-search"></i>
            </button>
        </div>
    </div>

    <div id="page-header-search" class="overlay-header bg-primary">
        <div class="content-header">
            <form class="w-100" action="be_pages_generic_search.html" method="POST">
                <div class="input-group">
                    <button type="button" class="btn btn-primary" data-toggle="layout" data-action="header_search_off">
                        <i class="fa fa-fw fa-times-circle"></i>
                    </button>
                    <input type="text" class="form-control border-0" placeholder="Search ..."
                        id="page-header-search-input" name="page-header-search-input">
                </div>
            </form>
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
