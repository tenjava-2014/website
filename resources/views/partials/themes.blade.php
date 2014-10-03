<h2>Themes</h2>
<p>As each timeslot starts, this page will list the available themes for each one. If you're participating, you
    need to choose one of the themes from your timeslot and note it in the README file. This should be the first
    thing you do at the start of your timeslot. Unsure which timeslot you selected? See <a href="/times/select">this page</a>.</p>
<p>We suggest you spend some time at the start of your timeslot thinking about an idea you can use which relates to your chosen theme. </p>
<h2>Timeslot 1 ({{ $t1 }})</h2>
@if ($times->isT1Active() || $times->isT1Finished())
    @include("themes.t1")
@else
    <p>The themes for this timeslot are not yet available as it has not yet started.</p>
@endif
<h2>Timeslot 2 ({{ $t2 }})</h2>
@if ($times->isT2Active() || $times->isT2Finished())
    @include("themes.t2")
@else
    <p>The themes for this timeslot are not yet available as it has not yet started.</p>
@endif
<h2>Timeslot 3 ({{ $t3 }})</h2>
@if ($times->isT3Active() || $times->isT3Finished())
    @include("themes.t3")
@else
    <p>The themes for this timeslot are not yet available as it has not yet started.</p>
@endif