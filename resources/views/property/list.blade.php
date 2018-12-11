@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Property List</div>

                    <div class="panel-body">
                        @if(isset($properties))
                            @foreach($properties as $property)
                                <div class="row property-wrap">
                                    <div class="title">Title : <a href="{{ route('show_property', ['propertyId'=> $property->id]) }}">{{ $property->property_type }}</a></div>
                                    <div class="details">Address : {{ $property->address }} {{ $property->zip_code }}</div>
                                    <div class="details">Description : {{ $property->description }}</div>
                                </div>
                            @endforeach
                        @else
                            <div class="row property-wrap">
                                <div class="alert-warning">No properties found for this landlord!</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
