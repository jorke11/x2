@extends('layouts.app')
@section('content')

{!!Html::script('/vendor/treeview/logger.min.js')!!}
{!!Html::script('/vendor/treeview/treeview.js')!!}

<div class="row">
    <div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist" id='myTabs'>
            <li role="presentation" class="active"><a href="#list" aria-controls="home" role="tab" data-toggle="tab">List</a></li>
            <li role="presentation" id="tabManagement"><a href="#management" aria-controls="profile" role="tab" data-toggle="tab">Management</a></li>
            <li role="presentation" id="tabPermission"><a href="#permission" aria-controls="profile" role="tab" data-toggle="tab">Permission</a></li>
            <li role="presentation" id="tabUplod"><a href="#upload" aria-controls="special" role="tab" data-toggle="tab">Load</a></li>

        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="list">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @include('Security.users.list')
                    </div>
                </div>

            </div>
            <div role="tabpanel" class="tab-pane " id="management">
                <div class="panel panel-default">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-lg-12 text-right">
                                <button class="btn btn-success btn-sm" id='btnNew'>
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                </button>
                                <button class="btn btn-success btn-sm" id='btnSave' disabled>
                                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @include('Security.users.management')
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane " id="permission">
                <div class="panel panel-default">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-lg-12 text-left">
                                <button class="btn btn-success" id='btnPermission'>
                                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @include('Security.users.permission')
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane " id="upload">
                @include('Security.users.upload')
            </div>

        </div>
    </div>
</div>
{!!Html::script('js/Security/User.js')!!}
@endsection