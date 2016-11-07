<div id="nav" class="visible-lg visible-md">
    <div class="container border-bottom">
        <div class="row">
            <ul id="navmenu" class="nav navbar-nav">
                @foreach(App\Category::getCategories() as $cat )
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

                <li class="hidden-md hidden-lg">
                    <a href=""> Edetabel</a>
                </li>
                <div class="leaderboard pull-right visible-md visible-lg">
                    <a class="center-block" href="#" target="_blank" title="Leaderboard"></a>
                </div>
                <div class="search-container">
                    <div class="search">
                        <form id="search-form">
                            <input class="search-input" placeholder="Otsi..."
                                   type="search" value="" name="search" id="search">
                            <input class="search-btn" type="submit" value="">
                            <span class="search-icon"><span class="glyphicon glyphicon-search"></span></span>
                        </form>
                    </div>
                </div>
            </ul>
        </div>
    </div>
</div>