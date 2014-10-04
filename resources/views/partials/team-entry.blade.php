<div class="grid-20 tablet-grid-50 mobile-grid-50 team-entry-parent">
    <div class="team-entry text-center">
        <img src="/assets/img/avatars/{{ strtolower($username) }}.png" alt="{{ $username }}'s avatar">

        <h3>{{ $username }}</h3>

        <p>{!! Lang::get("team-bios." . $username) !!}</p>
    </div>
</div>
