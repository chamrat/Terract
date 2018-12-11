@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Property Unit</div>
{{--{{ var_dump($data) }}{{ die() }}--}}
                    <div class="panel-body">
                        @if(isset($message))
                        <div class="alert-success">
                            {{ $message }}
                        </div>
                        @endif

                        @if(isset($properties))
                                <form class="form-horizontal" method="POST" action="{{ route('save_unit') }}">
                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('property_id') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">Property</label>

                                        <div class="col-md-6">
                                            <select id="property_id" class="form-control" name="property_id" required autofocus>
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

                                    <div class="form-group{{ $errors->has('unit_type') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">Property Unit Type</label>

                                        <div class="col-md-6">
                                            <select id="unit_type" class="form-control" name="unit_type" required autofocus>
                                                <option> -- Select Unit Type --</option>
                                                @foreach ($unitTypes as $unitType):
                                                <option value="{{ $unitType }}">{{ $unitType }}</option>
                                                @endforeach
                                            </select>

                                            @if ($errors->has('unit_type'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('unit_type') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('reference_name') ? ' has-error' : '' }}">
                                        <label for="address" class="col-md-4 control-label">Reference Name</label>

                                        <div class="col-md-6">
                                            <input id="reference_name" type="text" class="form-control" name="reference_name" value="{{ old('reference_name') }}" required autofocus>

                                            @if ($errors->has('reference_name'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('reference_name') }}</strong>
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
                                                Add Property Unit
                                            </button>
                                        </div>
                                    </div>
                                </form>
                        @else
                            <div class="alert-warning">No property found</div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
