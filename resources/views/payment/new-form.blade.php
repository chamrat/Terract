@extends('layouts.app')

@section('content')

    {{--{{ var_dump($propertyUnits) }} {{ die() }}--}}
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Make a Payment</div>

                    <div class="panel-body">
                        @if(isset($message))
                        <div class="alert-success">
                            {{ $message }}
                        </div>
                        @endif
                        <form class="form-horizontal" method="POST" action="{{ route('save_payment') }}">
                            {{ csrf_field() }}

                            <input type="hidden" name="hasCards" id="hasCards" value="{{ $hasCards }}">
                            <div class="form-group{{ $errors->has('property_unit') ? ' has-error' : '' }}">
                                <label for="property_unit" class="col-md-4 control-label">Property Unit</label>

                                <div class="col-md-6">
                                    <select id="property_unit" class="form-control" name="property_unit" required autofocus>
                                        <option> -- Select Property Unit --</option>
                                        @foreach ($propertyUnits as $propertyUnit):
                                        <option value="{{ $propertyUnit->id }}">{{ $propertyUnit->reference_name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('property_unit'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('property_unit') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                <label for="amount" class="col-md-4 control-label">Amount</label>

                                <div class="col-md-4">
                                    <input id="amount" type="number" class="form-control" name="amount" value="{{ old('amount') }}" required autofocus>

                                    @if ($errors->has('amount'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
                                <label for="note" class="col-md-4 control-label">Note</label>

                                <div class="col-md-6">
                                    <textarea id="note" class="form-control" rows="3" name="note"></textarea>

                                    @if ($errors->has('note'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('note') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('payment_month') ? ' has-error' : '' }}">
                                <label for="payment_month" class="col-md-4 control-label">Payment Month</label>

                                <div class="col-md-4">
                                    <select id="payment_month" class="form-control" name="payment_month" required autofocus>
                                        <option> -- Select Pay Month --</option>
                                        @foreach ($payMonths as $id=>$month):
                                        <option value="{{ $id }}">{{ $month }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('payment_month'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('payment_month') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('payment_method') ? ' has-error' : '' }}">
                                <label for="payment_method" class="col-md-4 control-label">Payment Method</label>

                                <div class="col-md-6">
                                    <select id="payment_method" class="form-control" name="payment_method" required autofocus>
                                        <option> -- Select Payment Method --</option>
                                        @foreach($payMethods as $payMethod)
                                        <option value="{{ $payMethod }}">{{ $payMethod }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('payment_method'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('payment_method') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--credit card launcher--}}
                            @if(isset($creditCards))
                            <div class="credit-card-launcher" id="credit-card-launcher">
                                <div class="form-group{{ $errors->has('available_cards') ? ' has-error' : '' }}">
                                    <label for="available_cards" class="col-md-4 control-label">Available Cards</label>

                                    <div class="col-md-4">
                                        <select id="available_cards" class="form-control" name="available_cards" autofocus>
                                            <option> -- Select Credit Card -- </option>
                                            @foreach($creditCards as $card)
                                                <option value="{{ $card->id }}">{{ $card->card_number }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('available_cards'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('available_cards') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    </br>
                                    <div class="col-md-6 col-md-offset-4">
                                        <button class="btn btn-primary" type="button" id="addNewCard">Add New</button>
                                    </div>
                                </div>
                            </div>
                            @endif

                            {{--credit card information collection space--}}
                            <div id="cc-wrapper">
                                <div class="form-group{{ $errors->has('card_number') ? ' has-error' : '' }}">
                                    <label for="card_number" class="col-md-4 control-label">Card Number</label>

                                    <div class="col-md-4">
                                        <input id="card_number" type="number" class="form-control" name="card_number" value="{{ old('card_number') }}"  autofocus>

                                        @if ($errors->has('card_number'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('card_number') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('expiration_year') ? ' has-error' : '' }}">
                                    <label for="card_number" class="col-md-4 control-label">Expiration Date</label>

                                    <div class="col-md-3">
                                        <label for="expiration_year" class="col-md-1">Year</label>
                                        <input id="expiration_year" type="number" class="form-control col-md-2" name="expiration_year" value="{{ old('expiration_year') }}"  autofocus>

                                        @if ($errors->has('expiration_year'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('expiration_year') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <label for="expiration_month" class="col-md-1">Month</label>
                                        <input id="expiration_month" type="number" class="form-control col-md-2" name="expiration_month" value="{{ old('expiration_month') }}"  autofocus>

                                        @if ($errors->has('expiration_month'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('expiration_month') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('cvv') ? ' has-error' : '' }}">
                                    <label for="cvv" class="col-md-4 control-label">Cvv</label>

                                    <div class="col-md-3">
                                        <input id="cvv" type="number" class="form-control" name="cvv" value="{{ old('cvv') }}"  autofocus>

                                        @if ($errors->has('cvv'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('cvv') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('billing_address') ? ' has-error' : '' }}">
                                    <label for="cvv" class="col-md-4 control-label">Billing Address</label>

                                    <div class="col-md-6">
                                        <input id="billing_address" type="text" class="form-control" name="billing_address" value="{{ old('billing_address') }}"  autofocus>

                                        @if ($errors->has('billing_address'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('billing_address') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('billint_zip_code') ? ' has-error' : '' }}">
                                    <label for="cvv" class="col-md-4 control-label">Billing Zip Code</label>

                                    <div class="col-md-6">
                                        <input id="billint_zip_code" type="text" class="form-control" name="billint_zip_code" value="{{ old('billint_zip_code') }}"  autofocus>

                                        @if ($errors->has('billint_zip_code'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('billint_zip_code') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Submit Payment
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
