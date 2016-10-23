<header class="admin-page-header">
    <!--logo start-->
    <div class="admin-page-header-row">

        <span class="header-title hidden-sm hidden-xs">@yield('description')</span>

        <div class="empty-space"></div>

        <form id="logout-form"
              action="@if (App::isLocal()) {{ url('/logout') }} @else{{ secure_url('/logout') }} @endif "
              method="POST">
            <button class="btn btn-primary btn-raised" type="submit">Logi välja
            </button>
            {{ csrf_field() }}

        </form>
    </div>
    <!--logo end-->
</header>