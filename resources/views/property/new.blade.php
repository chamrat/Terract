@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Property</div>

                    <div class="panel-body">
                        @if(isset($data['message']))
                        <div class="alert-success">
                            {{ $data['message'] }}
                        </div>
                        @endif
                        <form class="form-horizontal" method="POST" action="{{ route('save_property') }}">
                            {{ csrf_field() }}

                            <input type="hidden" name="landlord_id" value="{{ $data['landlordId'] }}">
                            <div class="form-group{{ $errors->has('property_type') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Property Type</label>

                                <div class="col-md-6">
                                    <select id="property_type" class="form-control" name="property_type" required autofocus>
                                        <option> -- Select Property Type --</option>
                                        @foreach ($data['propertyTypes'] as $propertyType):
                                        <option value="{{ $propertyType }}">{{ $propertyType }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('property_type'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('property_type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="col-md-4 control-label">Address</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required autofocus>

                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('zip_code') ? ' has-error' : '' }}">
                                <label for="zip_code" class="col-md-4 control-label">Zip Code</label>

                                <div class="col-md-6">
                                    <input id="zip_code" type="text" class="form-control" name="zip_code" value="{{ old('zip_code') }}" required autofocus>

                                    @if ($errors->has('zip_code'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('zip_code') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('number_of_units') ? ' has-error' : '' }}">
                                <label for="number_of_units" class="col-md-4 control-label">Number Of Units</label>

                                <div class="col-md-6">
                                    <input id="number_of_units" type="number" class="form-control" name="number_of_units" value="{{ old('number_of_units') }}" required autofocus>

                                    @if ($errors->has('number_of_units'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('number_of_units') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    <textarea id="description" class="form-control" name="description" required autofocus></textarea>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Add Property
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
