@extends('layouts.donate')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
            @if ($errors->any())
            <div class="alert block error">
                <h4>Request errors</h4>
                <ul>
                    @foreach($errors->all('<li>:message</li>') as $message)
                    {!! $message !!}
                    @endforeach
                </ul>
            </div>
            @endif
            @if (isset($success) && $success)
            <div class="alert block success">
                <h4>Success!</h4>
                <p>
                    Donation made! Thank you very much!
                </p>
                <p class="text-light-plain">
                    For your records, this transaction will show up on your statement as <code>{{ $description }}</code>.
                </p>
            </div>
            @endif
            <h2>Donate<i style="float: right; color: green; cursor: default;" title="Secured." class="fa fa-lock"></i></h2>
            <p>
                Our current prize pool is $1,000,000,000,000 USD! You can contribute by donating to it! Every little bit
                counts!
            </p>
            <p>
                We care about security. As evidence, our servers never touch your sensitive data. The service we use to
                charge your card, <a href="https://stripe.com/">Stripe</a>, handles all of your data, through encrypted
                channels. All we get back is an encrypted message to use. Even if we wanted to, we couldn't handle your
                sensitive data. If you have questions, <a href="#">contact us</a>.
            </p>
            <p>
                <strong>Please read!</strong> Stripe applies a 2.9% + 30¢ fee to any donation you make. This means that
                if you donate $10.00, the prize pool will only increase by $9.41, etc.
            </p>
            {!! Form::open(['route' => 'donate', 'class' => 'form', 'id' => 'donation-form']) !!}
            <div id="donation-errors" class="alert block error"></div>
            <div class="control-group">
                {!! Form::label('email', 'Email Address (for receipt)') !!}
                <div class="control">
                    {!! Form::email('email', Auth::user()->email, ['id' => 'email', 'placeholder' => 'you@example.com', 'data-stripe' => 'email']) !!}
                </div>
            </div>
            <div class="control-group">
                {!! Form::label('name', 'Cardholder Name') !!}
                <div class="control">
                    {!! Form::text('name', Auth::user()->name, ['id' => 'name', 'placeholder' => 'John Doe', 'data-stripe' => 'name']) !!}
                </div>
            </div>
            <div class="control-group">
                {!! Form::label('card', 'Credit Card') !!}
                <div class="control">
                    {!! Form::text(null, null, ['size' => 20, 'id' => 'card', 'placeholder' => 'XXXX XXXX XXXX XXXX', 'data-stripe' => 'number']) !!}
                </div>
            </div>
            <div class="control-group">
                {!! Form::label('cvc', 'CVC') !!}
                <div class="control">
                    {!! Form::text(null, null, ['size' => 4, 'id' => 'cvc', 'placeholder' => 'XXXX', 'data-stripe' => 'cvc']) !!}
                </div>
            </div>
            <div class="control-group">
                {!! Form::label('expiration', 'Expiration (MM/YYYY)') !!}
                <div class="controls">
                    {!! Form::text(null, null, ['size' => '2', 'id' => 'exp-month', 'placeholder' => 'MM', 'data-stripe' => 'exp-month']) !!}
                    /
                    {!! Form::text(null, null, ['size' => '4', 'id' => 'exp-year', 'placeholder' => 'YYYY', 'data-stripe' => 'exp-year']) !!}
                </div>
            </div>
            <div class="control-group">
                {!! Form::label('amount', 'Amount (in USD)') !!}
                <div class="control">
                    {!! Form::input('number', 'amount', null, ['step' => 'any', 'placeholder' => '10.00', 'id' => 'amount']) !!}
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    {!! Form::checkbox('hidden', '1', false, ['id' => 'hidden']) !!}
                    {!! Form::label('hidden', 'Check this box if you would like to keep your donation hidden from the public.') !!}
                </div>
                <div class="controls">
                    {!! Form::checkbox('agreement', '1', false, ['id' => 'agreement']) !!}
                    {!! Form::label('agreement', 'I understand that there will be a handling fee and that not all of my donated money will be added to the prize pool (as noted above).') !!}
                </div>
                <div class="controls">
                    {!! Form::checkbox('terms', '1', false, ['id' => 'terms']) !!}
                    <label for="terms">I agree to the <a href="{!! URL::route('terms') !!}">terms of service</a>.</label>
                </div>
            </div>
            <button class="button button-large button-block button-flat-primary"><i class="fa fa-lock"></i> Donate</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop

@section('post-scripts')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    function stripeResponseHandler(status, response) {
        var $form = $('#donation-form');
        if (response.error) {
            $form.find('#donation-errors').html('<h4>Oops!</h4><p>' + response.error.message.replace(/\.$/g, '') + '.</p>');
            $form.find('button').prop('disabled', false);
        } else {
            var token = response.id;
            $form.append($('<input type="hidden" name="stripeToken"/>').val(token));
            $form.get(0).submit();
        }
    }
    Stripe.setPublishableKey('{!! $_ENV["STRIPE_PUBLISHABLE_KEY"] !!}');
    jQuery(function($) {
        $('#donation-form').submit(function(event) {
            var $form = $(this);
            $form.find('button').prop('disabled', true);
            Stripe.card.createToken($form, stripeResponseHandler);
            return false;
        });
    });
</script>
@stop
