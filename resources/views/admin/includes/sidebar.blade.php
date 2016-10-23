<div id="sidebar">
    <!-- sidebar menu start-->
    <a href="#" class="sidebar-logo withripple padding-10">
        <img src="@if (App::isLocal()) {{asset('img/logo.png')}} @else {{secure_asset('img/logo.png')}} @endif"
             alt="Logo"/></a>

    <header class="sidebar-header text-center" id="nav-accordion">
        <i class="fa fa-cogs fa-10x color-yellow" aria-hidden="true"></i>
        <span class="font-size-md">Martin Peedosk</span>
    </header>

    <div class="sidebar-nav">

        <a href="/" class="sidebar-item withripple">
            <i class="fa fa-fw fa-long-arrow-left "></i> Tagasi pealehele

        </a>

        <a href="#" class="sidebar-item withripple sidebar-item-active">
            <i class="fa fa-fw fa-picture-o"></i> Nupuvere
        </a>

        <a href="#" class="sidebar-item withripple">
            <i class="fa fa-fw fa-book"></i> Kategooriad
        </a>

        <a href="#" class="sidebar-item withripple">
            <i class="fa fa-fw fa-list-alt"></i> Ülesanded
        </a>


        <a href="#" class="sidebar-item withripple">
            <i class="fa fa-fw fa-trophy"></i> Edetabel
        </a>

        <a href="#" class="sidebar-item withripple">
            <i class="fa fa-fw fa-users"></i> Administraatorid
        </a>
    </div>
</div>
