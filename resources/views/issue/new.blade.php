@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Report an Issue</div>

                    <div class="panel-body">
                        @if(isset($messsage))
                        <div class="alert-success">
                            {{ $messsage }}
                        </div>
                        @endif

                        @if(isset($propertyUnit))
                                <form class="form-horizontal" method="POST" action="{{ route('save_issue') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="unit_id" value="{{ $propertyUnit }}">
                                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">Subject</label>

                                        <div class="col-md-6">
                                            <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                                            @if ($errors->has('title'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
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
                                                Report an issue
                                            </button>
                                        </div>
                                    </div>
                                </form>
                        @else
                            <div class="alert-warning">No property unit found</div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
