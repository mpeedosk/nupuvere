<div id="nav" class="visible-lg visible-md">
    <div class="container border-bottom">
        <div class="row">
            <div class="col-md-11 no-padding">
                <ul id="navmenu" class="nav navbar-nav">
                    @foreach(App\Category::getCategories() as $cat )
                        <li @if(isset($category)&& $category == mb_strtolower($cat->name) )class="nav-bar-active"@endif>
                            <span>{{ucfirst($cat->name)}}</span>
                            <ul>
                                <li>
                                    <div>
                                        <a class="withripple" href="/{{mb_strtolower($cat->name)}}/avastaja">Avastajad
                                            <em class="pull-right">(.. - 2.kl)</em></a>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <a class="withripple" href="/{{mb_strtolower($cat->name)}}/uurija">Uurijad
                                            <em class="pull-right">(3. - 6.kl)</em></a>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <a class="withripple" href="/{{mb_strtolower($cat->name)}}/teadja">Teadjad
                                            <em class="pull-right">(7. - 9. kl)</em></a>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <a class="withripple" href="/{{mb_strtolower($cat->name)}}/ekspert">Eksperdid
                                            <em class="pull-right">(10. - 12. kl)</em></a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    @endforeach
                    <li class="hidden-md hidden-lg">
                        <a href=""> Edetabel</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-1 leaderboard no-padding">
                    <div>
                        <a class="center-block" href="#" target="_blank" title="Leaderboard"></a>
                    </div>
            </div>
        </div>
    </div>
</div>