@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome {{ Auth::user()->firstName }},</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div id="buttonsDashboard">
                    <div class="btn-group-vertical">
                        <button type="button" class="btn btn-info"> <a id="dboardTag" href=" {{ route('list_property') }}"><img src="{!! asset("/Images/building.png" ) !!}" width="20" height="20" /> View Properties </a></button>
                    </br>
                        <button type="button" class="btn btn-info"><a id="dboardTag" href="{{ route('view_payment') }}"><img src="{!! asset("/Images/payments.png" ) !!}" width="20" height="20" /> View Payments </a></button>
                    </br>
                        <button type="button" class="btn btn-info"><a id="dboardTag" href="{{ route('view_issues') }}"><img src="{!! asset("/Images/issues.png" ) !!}" width="20" height="20" />      View Issues </a></button>
                    </br>
                        <button type="button" class="btn btn-info"><a id="dboardTag" href="{{ route('invite_tenant') }}"><img src="{!! asset("/Images/Invite.png" ) !!}" width="20" height="20" />  Invite Tenant </a></button>
                    </br>

                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
