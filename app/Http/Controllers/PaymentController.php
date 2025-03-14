<?php
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Actions\Web\PaymentActions;
 
class PaymentController extends Controller
{

    protected $paymentActions;

    public function __construct(PaymentActions $paymentActions)
    {
        $this->paymentActions = $paymentActions;
    }

    public function index()
    {
        return view('payment');
    }
 
    public function charge(Request $request)
    {

        // Validate request
        $request->validate([
            'order_id' => 'required',
            'cc_number' => 'required',
            'expiry_month' => 'required',
            'expiry_year' => 'required',
            'cvv' => 'required',
        ]);

        $res = $this->paymentActions->processPayment($request);

        if( $res['status'] == 'failed' ) {
            return redirect()->back()->with('error', $res['errors']);
        } else {
            return redirect()->back()->with('success', 'Payment successful');
        }

    }

}