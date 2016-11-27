<div id="nav" class="visible-lg visible-md">
    <div class="container border-bottom">
        <div class="row">
            <ul id="navmenu" class="nav navbar-nav">
                @foreach(App\Category::getCategories() as $cat )
                    @if($loop->iteration > 6)
                        @break
                    @endif
                    <li style="border-bottom: 4px solid {{$cat->color}}; @if(isset($category)&& $category ==
                        mb_strtolower($cat->name) ) background-color: {{$cat->color}};@endif">
                        <span>{{str_replace('_', ' ', ucfirst($cat->name)) }}</span>
                        <ul>
                            <li style="border-bottom: 3px solid {{shade4($cat->color)}}">
                                <div>
                                    <a class="withripple"
                                       href="/{{str_replace(' ', '_', mb_strtolower($cat->name))}}/avastaja">Avastajad
                                        <em class="pull-right">(.. - 2.kl)</em></a>
                                </div>
                            </li>
                            <li style="border-bottom: 3px solid {{shade3($cat->color)}}">
                                <div>
                                    <a class="withripple"
                                       href="/{{str_replace(' ', '_', mb_strtolower($cat->name))}}/uurija">Uurijad
                                        <em class="pull-right">(3. - 6.kl)</em></a>
                                </div>
                            </li>
                            <li style="border-bottom: 3px solid {{shade1($cat->color)}}">
                                <div>
                                    <a class="withripple"
                                       href="/{{str_replace(' ', '_', mb_strtolower($cat->name))}}/teadja">Teadjad
                                        <em class="pull-right">(7. - 9. kl)</em></a>
                                </div>
                            </li>
                            <li style="border-bottom: 3px solid {{shade1($cat->color)}}">
                                <div>
                                    <a class="withripple"
                                       href="/{{str_replace(' ', '_', mb_strtolower($cat->name))}}/ekspert">Eksperdid
                                        <em class="pull-right">(10. - 12. kl)</em></a>
                                </div>
                            </li>

                        </ul>
                    </li>
                @endforeach

                @if(count(App\Category::getCategories()) > 6)
                    <li class="menu-expand">
                        <span class="hidden-md hidden-lg">Muu</span>
                        <i class="fa fa-bars fa-2x visible-md visible-lg" aria-hidden="true"></i>
                        <ul>
                            @foreach(App\Category::getCategories() as $cat )
                                @if($loop->iteration <= 6)
                                    @continue
                                @endif
                                <li style="border-bottom: 4px solid {{$cat->color}}; @if(isset($category)&& $category ==
                        mb_strtolower($cat->name) ) background-color: {{$cat->color}};@endif">
                                    <span>{{str_replace('_', ' ', ucfirst($cat->name)) }}</span>
                                    <ul>
                                        <li style="border-bottom: 3px solid {{shade4($cat->color)}}">
                                            <div>
                                                <a class="withripple"
                                                   href="/{{str_replace(' ', '_', mb_strtolower($cat->name))}}/avastaja">Avastajad
                                                    <em class="pull-right">(.. - 2.kl)</em></a>
                                            </div>
                                        </li>
                                        <li style="border-bottom: 3px solid {{shade3($cat->color)}}">
                                            <div>
                                                <a class="withripple"
                                                   href="/{{str_replace(' ', '_', mb_strtolower($cat->name))}}/uurija">Uurijad
                                                    <em class="pull-right">(3. - 6.kl)</em></a>
                                            </div>
                                        </li>
                                        <li style="border-bottom: 3px solid {{shade1($cat->color)}}">
                                            <div>
                                                <a class="withripple"
                                                   href="/{{str_replace(' ', '_', mb_strtolower($cat->name))}}/teadja">Teadjad
                                                    <em class="pull-right">(7. - 9. kl)</em></a>
                                            </div>
                                        </li>
                                        <li style="border-bottom: 3px solid {{shade1($cat->color)}}">
                                            <div>
                                                <a class="withripple"
                                                   href="/{{str_replace(' ', '_', mb_strtolower($cat->name))}}/ekspert">Eksperdid
                                                    <em class="pull-right">(10. - 12. kl)</em></a>
                                            </div>
                                        </li>

                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif

                <li class="hidden-md hidden-lg">
                    <a href="/edetabel"> Edetabel</a>
                </li>
                <a href="/edetabel" title="Edetabel" class="leaderboard pull-right visible-md visible-lg">
                    <span class="center-block"></span>
                </a>

                <div class="search-container visible-md visible-lg">
                    <div class="search">
                        <form id="search-form" action="/search" method="POST">
                            {{ csrf_field() }}
                            <input class="search-input" placeholder="Otsi..."
                                   type="search" value="" name="search" id="search">
                            <input class="search-btn" type="submit" value="">
                            <span class="search-icon"><span class="glyphicon glyphicon-search"></span></span>
                        </form>
                    </div>
                </div>

                <li class="hidden-md hidden-lg">
                    <div class="search-slicknav">
                        <form id="search-form" action="/search" method="POST">
                            {{ csrf_field() }}
                            <button type="submit" class="search-icon-slicknav">
                                <span class="glyphicon glyphicon-search"></span></button>
                            <span class="search-input-wrapper"><input class="search-input-slicknav"
                                                                      placeholder="Otsi..."
                                                                      type="search" value="" name="search" id="search"></span>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>