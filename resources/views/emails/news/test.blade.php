@extends('emails.news.template')
@section('content')
    <h1>Hey, {{{ $name }}}!</h1>
    <p>
        This is a test email verifying your subscription to ten.java updates. This should never be sent to anyone but
        jkcclemens, really.
    </p>
    <p>
        Here's some data!
    </p>
    <ul>
        <li>Name: {{{ $name }}}</li>
        <li>Email: {{{ $email }}}</li>
        <li>ID: {{{ $id }}}</li>
    </ul>
    <p>
        Thanks,<br/>
        The ten.java Team
    </p>
@stop
