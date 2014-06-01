<div class="grid-20 mobile-grid-50">
    <div class="team-entry text-center">
        <img
            src="/assets/img/avatars/{{{ strtolower($username) }}}.png">

        <h3>{{{ $username }}}</h3>

        <p>{{ Lang::get("team-bios." . $username) }}</p>
    </div>
</div>