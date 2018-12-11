@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reported Issues</div>

                <div class="panel-body">
                    @if(isset($issues))
                    @foreach($issues as $issue)
                    <div class="row property-wrap">
                        <div class="title">Title : {{ $issue['title'] }}</div>
                        <div class="details">Description : {{ $issue['description'] }}</div>
                        <div class="details">Property Unit : {{ $issue['propertyUnit'] }}</div>
                    </div>
                    @endforeach
                    @else
                    <div class="row property-wrap">
                        <div class="alert-warning">No Issues found!</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
