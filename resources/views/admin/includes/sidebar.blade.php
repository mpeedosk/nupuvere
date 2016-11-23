<div id="sidebar">
    <!-- sidebar menu start-->
    <a href="/" class="sidebar-logo withripple padding-10">
        <img src="@if (App::isLocal()) {{asset('img/logo.png')}} @else {{secure_asset('img/logo.png')}} @endif"
             alt="Logo"/></a>

    <header class="sidebar-header text-center" id="nav-accordion">
        <span class="fa fa-cogs fa-10x color-yellow" aria-hidden="true"></span>
        <span class="font-size-md">Martin Peedosk</span>
    </header>

    <div class="sidebar-nav">

        <a href="/" class="sidebar-item withripple">
            <span class="fa fa-fw fa-long-arrow-left "></span> Tagasi pealehele

        </a>
        <a href="/admin/home" class="sidebar-item withripple
            @if(Route::getCurrentRoute()->getPath() == 'admin/home') sidebar-item-active @endif">
            <span class="fa fa-fw fa-picture-o"></span> Nupuvere
        </a>

        <a href="/admin/category" class="sidebar-item withripple
            @if(Route::getCurrentRoute()->getPath() == 'admin/category') sidebar-item-active @endif">
            <span class="fa fa-fw fa-book"></span> Kategooriad
        </a>

        <a href="/admin/exercise" class="sidebar-item withripple
            @if(Route::getCurrentRoute()->getPath() == 'admin/exercise') sidebar-item-active @endif">
            <span class="fa fa-fw fa-list-alt"></span> Ülesanded
        </a>


        <a href="/admin/highscore" class="sidebar-item withripple
            @if(Route::getCurrentRoute()->getPath() == 'admin/highscore') sidebar-item-active @endif">
            <span class="fa fa-fw fa-trophy"></span> Edetabel
        </a>

        @if(Auth::user()->isSuperAdmin())
            <a href="/admin/admins" class="sidebar-item withripple
            @if(Route::getCurrentRoute()->getPath() == 'admin/admins') sidebar-item-active @endif">
                <span class="fa fa-fw fa-users"></span> Administraatorid
            </a>
        @endif
    </div>
</div>
