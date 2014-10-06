<div class="username{!! $useLeader && $user == $team->leader ? ' leader' : '' !!}">
    @if ($removeLink)<a class="remove" href="{!! $removeLink !!}"><i class="fa fa-times"></i></a>@endif
    @if ($acceptLink)<a class="remove" href="{!! $acceptLink !!}"><i class="fa fa-check"></i></a>@endif
    <img alt="{{ $user->username }}" src="https://avatars3.githubusercontent.com/u/{!! $user->gh_id !!}?v=2&amp;s=32"/>
    {{ $user->username }}
</div>
