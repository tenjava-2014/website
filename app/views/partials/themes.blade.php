<h2>Themes</h2>
<p>
  This page lists the themes that were available for participants to choose from in the most recent contest.
  Participants documented their theme choice in their repo's README file and then set out to build an idea using the theme.
  We awarded points for plugins that used their chosen theme well.
</p>

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
