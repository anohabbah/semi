<!-- left menu starts -->
<div class="col-sm-2 col-lg-2">
    <div class="sidebar-nav">
        <div class="nav-canvas">
            <div class="nav-sm nav nav-stacked">
                &nbsp;
            </div>
            <ul class="nav nav-pills nav-stacked main-menu">
                <li class="nav-header">Main</li>
                <li><a class="ajax-link" href="index.html"><i
                                class="glyphicon glyphicon-home"></i><span> Dashboard</span></a>
                </li>
                <li class="accordion">
                    <a href="#"><i class="glyphicon glyphicon-plus"></i><span> Documents</span></a>
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="{{ route('articles.index') }}">Liste des Documennts</a></li>
                        <li><a href="{{ route('articles.create') }}">Ajouter un Document</a></li>
                    </ul>
                </li>
            </ul>
            <label id="for-is-ajax" for="is-ajax"><input id="is-ajax" type="checkbox"> Ajax on menu</label>
        </div>
    </div>
</div>
<!--/span-->
<!-- left menu ends -->

<noscript>
    <div class="alert alert-block col-md-12">
        <h4 class="alert-heading">Warning!</h4>

        <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
            enabled to use this site.</p>
    </div>
</noscript>
