@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Property Information</div>

                    <div class="panel-body">
                        <div class="row property-wrap">
                            <div class="title">Title : {{ $property->property_type }}</div>
                            <div class="details">Address : {{ $property->address }} {{ $property->zip_code }}</div>
                            <div class="details">Description : {{ $property->description }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
