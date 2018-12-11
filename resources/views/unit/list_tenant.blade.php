@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Property Unit Information</div>

                    <div class="panel-body">
                        @foreach($propertyUnits as $propertyUnit)
                        <div class="row property-wrap">
                            <div class="title">Type : {{ $propertyUnit->unit_type }}</div>
                            <div class="details">Name : {{ $propertyUnit->reference_name }}</div>
                            <div class="details">Description : {{ $propertyUnit->description }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
