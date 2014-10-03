@extends('layouts.master')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
            <h2>You're almost done!</h2>

            <div class="alert basic error"><p><strong>Important!</strong> You will not be able to participate unless you
                    select a time. You should do this as soon as possible.</p>
            </div>
            <p>Thanks for singing up as a participant. You may now <a
                    href="/times/select">choose</a> your contest timeslot.</p>

            <h3>Share to twitter</h3>

            <p>If you'd like to get more people involved you can share your sign-up to twitter using the button
                below:</p>
            <a href="https://twitter.com/intent/tweet?screen_name=tenjava&text=I%20just%20signed%20up%20for%20ten.java%202014!"
               class="twitter-mention-button" data-related="tenjava" data-dnt="true">Share my registration</a>
            <script>!function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                    if (!d.getElementById(id)) {
                        js = d.createElement(s);
                        js.id = id;
                        js.src = p + '://platform.twitter.com/widgets.js';
                        fjs.parentNode.insertBefore(js, fjs);
                    }
                }(document, 'script', 'twitter-wjs');</script>
        </div>
    </div>
</div>
@stop