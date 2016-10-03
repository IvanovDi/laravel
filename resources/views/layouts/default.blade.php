@include ('layouts.header')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offest-1">
            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    @yield('content')

                </div>
            </div>
        </div>
    </div>
</div>
@include ('layouts.footer')