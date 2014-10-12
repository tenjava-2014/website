<?php namespace TenJava\Http\Controllers\Authentication;

use Auth;
use Illuminate\Http\Request;
use Redirect;
use Stripe_Charge;
use Stripe_Error;
use TenJava\Donation;
use TenJava\Http\Controllers\Abstracts\BaseDonateController;
use TenJava\Http\Requests\DonateRequest;
use TenJava\Http\Requests\SendMoneyRequest;
use View;

class DonateController extends BaseDonateController {

    public function donate(DonateRequest $request) {
        $description = 'ten.java Donation from ' . (Auth::user()->name ? : Auth::user()->username);
        try {
            Stripe_Charge::create([
                'amount' => $request->amount * 100,
                'currency' => 'usd',
                'card' => $request->stripeToken,
                'description' => $description
            ]);
        } catch (Stripe_Error $e) {
            $json = $e->getJsonBody()['error'];
            $error = $json['message'] . '. Please try again.';
            return Redirect::back()->withErrors([$error])->withInput($request->except(['stripeToken']));
        }
        // TODO: Extract
        $donation = new Donation();
        $donation->amount = $request->amount;
        $donation->user_id = Auth::id();
        $donation->hidden = $request->hidden ? true : false;
        $donation->fee_applied = (Donation::all()->sum('amount') + $request->amount) > 1000;
        $donation->save();
        return View::make('donate.forms.donate')->with('success', true)->with('description', $description);
    }

    public function sendMoney(SendMoneyRequest $request) {
        $description = 'ten.java Organizer Donation from ' . (Auth::user()->name ? : Auth::user()->username);
        try {
            Stripe_Charge::create([
                'amount' => $request->amount * 100,
                'currency' => 'usd',
                'card' => $request->stripeToken,
                'description' => $description
            ]);
        } catch (Stripe_Error $e) {
            $json = $e->getJsonBody()['error'];
            $error = $json['message'] . '. Please try again.';
            return Redirect::back()->withErrors([$error])->withInput($request->except(['stripeToken']));
        }
        $donation = new Donation();
        $donation->amount = $request->amount;
        $donation->user_id = Auth::id();
        $donation->to_organizers = true;
        $donation->fee_applied = (Donation::all()->sum('amount') + $request->amount) > 1000;
        $donation->save();
        return View::make('donate.forms.send_money')->with('success', true)->with('description', $description);
    }

    public function showDonatePage() {
        $this->setPageTitle('Donate');
        $this->setActive('donate');
        return View::make('donate.forms.donate');
    }

    public function showSendMoneyPage() {
        $this->setPageTitle('Donate to organizers');
        $this->setActive('donate to organizers');
        return View::make('donate.forms.send_money');
    }
}
