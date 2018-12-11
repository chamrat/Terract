@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Property Unit List</div>

                    <div class="panel-body">
                        @if(isset($message))
                        <div class="alert-success">
                            {{ $message }}
                        </div>
                        @endif

                        @if(isset($properties))
                            <div class="form-group{{ $errors->has('property_id') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Property</label>

                                <div class="col-md-6">
                                    <select id="property_unit_property_id" class="form-control" name="property_id" required autofocus>
                                        <option> -- Select a Property --</option>
                                        @foreach ($properties as $property):
                                        <option value="{{ $property['id'] }}">{{ $property['property_type'] }},
                                            {{ $property['address'] }}, {{ $property['property_type'] }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('property_id'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('property_id') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div id="property_unit_list"></div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
