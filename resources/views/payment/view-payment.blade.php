@extends('layouts.app')

@section('content')

    {{--{{ var_dump($propertyUnits) }} {{ die() }}--}}
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Rent Payment History</div>

                    <div class="panel-body">
                        @if(isset($message))
                            <div class="alert-success">
                                {{ $message }}
                            </div>
                        @endif

                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <th>Property Unit</th>
                                <th>Payment Method</th>
                                <th>Payment Month</th>
                                <th>Payment Date</th>
                                <th>Note</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($returnPayments as $payment)
                            <tr>
                                <td>{{ $payment['property_unit_name'] }}</td>
                                <td>{{ $payment['payment_method'] }}</td>
                                <td>{{ $payment['payment_month'] }}</td>
                                <td>{{ $payment['payment_date'] }}</td>
                                <td>{{ $payment['note'] }}</td>
                                <td>${{ $payment['amount'] }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
