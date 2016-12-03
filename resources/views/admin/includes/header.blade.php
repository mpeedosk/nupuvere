<header class="admin-page-header">
    <div class="admin-page-header-row">
        <span class="header-title hidden-sm hidden-xs">@yield('description')</span>
        <div class="empty-space"></div>
        <form id="logout-form" onsubmit="startLoader(this)"
              action="@if (App::isLocal()) {{ url('/logout') }} @else{{ secure_url('/logout') }} @endif "
              method="POST">
            <button class="btn btn-primary btn-raised" type="submit">
                <span class="spinner"><span class="md-spinner md-spinner-white"></span></span>
                <span class="md-spinner-text">Logi välja</span>
            </button>
            {{ csrf_field() }}
        </form>
    </div>
</header>s