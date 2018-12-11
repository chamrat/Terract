<?php

namespace App\Http\Controllers;

use App\CreditCard;
use App\Payment;
use App\PropertyUnit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        $data = $this->getFormData();
        $propertyUnits = $data['propertyUnits'];
        $payMethods = $data['payMethods'];
        $payMonths = $data['payMonths'];
        $creditCards = $data['creditCards'];
        $hasCards = false;
        if(count($creditCards)>0){
            $hasCards = true;
        }
        return view('payment.new-form')
            ->with(compact('propertyUnits'))
            ->with(compact('payMethods'))
            ->with(compact('payMonths'))
            ->with(compact('creditCards'))
            ->with(compact('hasCards'));
    }

    public function getFormData()
    {
        $user = Auth::user();
        $creditCards = $user->creditCards()->get();
        $propertyUnits = $user->propertyUnits()->get();
        $payMethods = ['Credit Card', 'Debit Card', 'Google Pay'];
        $payMonths = $this->getMonthsOfYear();
        $data = ['propertyUnits'=>$propertyUnits, 'payMethods'=>$payMethods, 'payMonths'=>$payMonths, 'creditCards'=>$creditCards];
        return $data;
    }

    public function getMonthsOfYear()
    {
        $months = [1=>'January', 2=>'February', 3=>'March', 4=>'April', 5=>'May', 6=>'June', 7=>'July', 8=>'Augest', 9=>'September', 10=>'October', 11=>'November', 12=>'December'];
        return $months;
    }

    public function savePayment(Request $request, Payment $payment, CreditCard $card)
    {
        $payment->amount = $request->amount;
        $payment->payment_method = $request->payment_method;
        $payment->payment_date = Carbon::now();
        $payment->payment_month = $request->payment_month;
        $payment->status = 'Done';
        $payment->note = $request->note;
        $payment->tenant_id = Auth::user()->id;
        $payment->property_unit_id = $request->property_unit;
        try {
            $payment->save();
            if ($payment->payment_method == 'Credit Card' || $payment->payment_method == 'Debit Card') {
                if(isset($request->hasCards) && $request->hasCards==1){
                    $cardId = $request->available_cards;
                } else {
                    $card->card_number = $request->card_number;
                    $card->expiration_month = $request->expiration_month;
                    $card->expiration_year = $request->expiration_year;
                    $card->cvv = $request->cvv;
                    $card->billing_address = $request->billing_address;
                    $card->billint_zip_code = $request->billint_zip_code;
                    $card->tenant_id = Auth::user()->id;
                    $card->save();

                    $cardId = $card->id;
                }

                $payment->creditCard()->associate($cardId);
                $payment->save();
            }
            $message = 'Payment Made Successfully';
        } catch (\Exception $exception) {
            Log::notice($exception->getMessage());
            $message = 'Payment saving failed';
        }
        $data = $this->getFormData();
        $propertyUnits = $data['propertyUnits'];
        $payMethods = $data['payMethods'];
        $payMonths = $data['payMonths'];
        $creditCards = $data['creditCards'];
        $hasCards = false;
        if(count($creditCards)>0){
            $hasCards = true;
        }
        return view('payment.new-form')
            ->with(compact('propertyUnits'))
            ->with(compact('payMethods'))
            ->with(compact('payMonths'))
            ->with(compact('creditCards'))
            ->with(compact('hasCards'))
            ->with(compact('message'));
    }

    public function viewPayment()
    {
        $monthsOfYear = $this->getMonthsOfYear();
        $user = Auth::user();
        $userType = $user->roles()->get()[0]->name;
        $returnPayments = [];
        if ($userType=='Landlord') {
            $properties = $user->properties()->get();
            foreach ($properties as $property ) {
                $propertyUnits = $property->units()->get();
                foreach ($propertyUnits as $unit) {
                    $payments = $unit->payments()->get();
                    foreach ($payments as $payment) {
                        $paymentVal = [];
                        $paymentVal['id'] = $payment->id;
                        $paymentVal['amount'] = number_format((float)$payment->amount, 2, '.', '');
                        $paymentVal['payment_method'] = $payment->payment_method;
                        $paymentVal['payment_month'] = $monthsOfYear[$payment->payment_month];
                        $paymentVal['payment_date'] = $payment->payment_date;
                        $paymentVal['note'] = $payment->note;
                        $paymentVal['property_unit_name'] = $unit->reference_name;
                        $returnPayments[] = $paymentVal;
                    }
                }
            }
            return view('payment.view-payment')
                ->with(compact('returnPayments'));
        } if ($userType == 'Tenant') {
            $returnPayments = [];
            $monthsOfYear = $this->getMonthsOfYear();
            $propertyUnits = $user->propertyUnits()->get();
            foreach ($propertyUnits as $unit){
                $payments = $unit->payments()->get();
                foreach ($payments as $payment) {
                    $paymentVal = [];
                    $paymentVal['id'] = $payment->id;
                    $paymentVal['amount'] = number_format((float)$payment->amount, 2, '.', '');
                    $paymentVal['payment_method'] = $payment->payment_method;
                    $paymentVal['payment_month'] = $monthsOfYear[$payment->payment_month];
                    $paymentVal['payment_date'] = $payment->payment_date;
                    $paymentVal['note'] = $payment->note;
                    $paymentVal['property_unit_name'] = $unit->reference_name;
                    $returnPayments[] = $paymentVal;
                }
            }
        }
        return view('payment.view-payment')
            ->with(compact('returnPayments'));
    }
}
