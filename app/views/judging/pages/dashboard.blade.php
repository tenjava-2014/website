@extends('layouts.judging')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-60">
            <h2>Welcome!</h2>

            <p>Thanks for volunteering to help us judge ten.java! Now that the contest is over, it's up to all of you as
                a judging team to decide who wins. We've built this judging interface to try and make judging as
                painless
                as possible. If you have any suggestions or questions, please direct them to lol768.</p>
        </div>
        <div class="grid-40">
            <h2>Judging Server</h2>

            <p>Thanks to Intreppid, we're able to offer a test server to all judges. Each server has been allocated 1
                GiB of RAM which should be fine for testing plugins individually. That said, you don't need to use your
                testing server if you don't want to. If you'd prefer to test locally, please check with an organizer for
                information on the CraftBukkit/Java versions you should be using so that we can try to ensure test
                environments are consistent.</p>

            <div class="server-details"><strong>Server IP:</strong> thor.tenjava.com:{{{ $judgePort }}}<br /><strong></strong></div>
        </div>
    </div>
</div>
@stop
