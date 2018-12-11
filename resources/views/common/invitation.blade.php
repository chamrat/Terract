@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Send Invitation</div>

                    <div class="panel-body">
                        @if(isset($data['messsage']))
                        <div class="alert-success">
                            {{ $data['messsage'] }}
                        </div>
                        @endif
                        <form class="form-horizontal" method="POST" action="{{ route('invite_save') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('property') ? ' has-error' : '' }}">
                                <label for="property" class="col-md-4 control-label">Property</label>

                                <div class="col-md-6">

                                    @foreach($data['properties'] as $property)
                                        <input id="property-{{ $property['id'] }}" type="radio" class="radio-inline radio-change"
                                               name="property" required
                                               value="{{ $property['id'] }}">
                                        {{ $property['property_type'] }} {{ $property['address'] }}
                                        {{ $property['zip_code'] }}<br/>
                                    @endforeach

                                    @if ($errors->has('property'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('property') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div id="property_unit_cont" class="form-group{{ $errors->has('property_unit') ? ' has-error' : '' }}">
                                <label for="property_unit" class="col-md-4 control-label">Property Unit</label>

                                <div class="col-md-6">

                                    <div id="property_unit_list"></div>

                                    @if ($errors->has('property_unit'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('property_unit') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('tenant_email') ? ' has-error' : '' }}">
                                <label for="address" class="col-md-4 control-label">Tenant Email</label>

                                <div class="col-md-6">
                                    <input id="tenant_email" type="email" class="form-control"
                                           name="tenant_email" value="{{ old('tenant_email') }}" required autofocus>

                                    @if ($errors->has('tenant_email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('tenant_email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" id="invite-btn">
                                        Invite Tenant
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
