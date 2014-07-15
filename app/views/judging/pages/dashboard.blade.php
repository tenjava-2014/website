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

            <h2>Plugin assignment overview</h2>

            <p>We've automatically assigned all judges with a set of plugins such that each entry is judged exactly
                twice by two separate judges. Please do not disclose which entries you have been assigned to anyone
                (this includes other judges/organizers).</p>

            <h3>Completed plugins</h3>

            <h3>Remaining plugins</h3>
        </div>
        <div class="grid-40">
            <h2>Judging Server</h2>

            <p>Thanks to Intreppid, we're able to offer a test server to all judges. Each server has been allocated 1
                GiB of RAM which should be fine for testing plugins individually. That said, you don't need to use your
                testing server if you don't want to. If you'd prefer to test locally, please check with an organizer for
                information on the CraftBukkit/Java versions you should be using so that we can try to ensure test
                environments are consistent.</p>

            <div class="server-details"><strong>Server IP:</strong> thor.tenjava.com:{{{ $judgePort }}}<br /><br /><em>These connection details are specific to you. Please do not disclose them.</em></div>

            <p>For information on how to use the tools available to you on the judging servers, see the <a
                    href="/judging/help">help</a> page.</p>

            <h2>Maintaining a presence on IRC</h2>

            <p>As IRC is our primary communications medium, all judges should be making an effort to be available via
                IRC whenever possible during the judging period. This hasn't yet been a significant issue with most
                judges. If you aren't already using an IRC bouncer, you should look into obtaining one.</p>
        </div>
    </div>
</div>
<div class="grid-container">
    <div class="grid-100 grid-parent">
        <div class="grid-20 hide-on-mobile signup-image">
            <img src="/assets/img/thirdparty/clock.svg" alt="Clock icon">
        </div>
        <div class="grid-80">
            <h3>Judging deadline</h3>

            <p>We'd like all judges to try and ensure they have judged all of their assigned plugins by July 31st. We
                cannot guarantee that we will be able to provide testing/build servers beyond this date.</p>

            <!-- This is NOT necessarily when results will be announced for those looking into the code behind our judging system -->

            <p>If at any point you are unsure you will be able to complete all of your assigned entries, please contact
                an organizer <strong>as soon as possible</strong>.</p>
        </div>
    </div>
</div>
@stop