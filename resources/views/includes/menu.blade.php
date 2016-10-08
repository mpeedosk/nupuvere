<div id="nav" class="visible-lg visible-md">
    <div class="container no-padding border-bottom">
        <div class="row">
            <div class="col-md-10 no-padding">
                <ul id="navmenu" class="nav navbar-nav">
                    @foreach(App\Category::getCategories() as $category )
                        <li>
                            <span >{{$category->name}}</span>
                            <ul>
                                <li>
                                    <div>
                                        <a href="/{{mb_strtolower($category->name)}}/avastaja">Avastajad <i class="pull-right">(.. - 2.kl)</i></a>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <a href="/{{mb_strtolower($category->name)}}/uurija">Uurijad <i class="pull-right">(3. - 6.kl)</i></a>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <a href="/{{mb_strtolower($category->name)}}/teadja">Teadjad <i class="pull-right">(7. - 9. kl)</i></a>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <a href="/{{mb_strtolower($category->name)}}/ekspert">Eksperdid <i class="pull-right">(10. - 12. kl)</i></a>
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
            <div class="col-md-2 no-padding">
                <div class="leaderboard pull-right">
                    <a href="#" target="_blank" title="Leaderboard"></a>
                </div>
            </div>
        </div>
    </div>
</div>