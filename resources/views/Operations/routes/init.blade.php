@extends('layouts.app')

@section('content')

<div class="row">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist" id='myTabs'>
        <li role="presentation" class="active" id="tabList"><a href="#list" aria-controls="home" role="tab" data-toggle="tab">List</a></li>
        <li role="presentation" id="tabUplod"><a href="#management" aria-controls="special" role="tab" data-toggle="tab">Map</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="list">
            <div class="panel panel-default">
                <div class="panel-body">
                    @include('Operations.routes.list')
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane " id="management">
            @include('Operations.routes.map')
        </div>

    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcFlmyYRKDT8Gyki79QIbB8J0c5Zb2-xM" async></script>





@include('Operations.routes.form')
{!!Html::script('js/Operations/Routes.js')!!}
@endsection