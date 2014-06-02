@extends('layouts.master')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
            <h2>Why sign up?</h2>

            <div class="grid-80">
                <h3>Share your creation</h3>

                <p>By taking part in the contest and committing your code into the GitHub repository we create for you,
                    you'll be helping others learn by example. Additionally, we encourage contest winners to consider
                    making their entry into a full project and uploading it to somewhere like <a
                        href="http://dev.bukkit.org">BukkitDev</a>. In this way, the contest benefits the development
                    community by contributing more open-source code. Additionally, server admins will have additional
                    plugins available to them. Last year we had some very creative concepts and we feel it's important
                    that these plugins are shared with the community.</p>
            </div>
            <div class="grid-20">
                <img src="/assets/img/thirdparty/share.svg" style="width: 100%">
            </div>
            <div class="grid-80 mobile-grid">
                <h3>Points</h3>

                <p>We've already raised {{ number_format($pointsData->points) }} CurseForge points which is equivalent
                    to ${{ number_format($pointsData->points * 0.05, 2) }}. By participating, you have the chance to win
                    a share of the prize fund. We're giving 50% to the winning entry and 30% and 20% to 2nd and 3rd
                    place respectively. Points can be cashed out via PayPal or redeemed as Amazon gift cards so it's
                    definitely worth getting involved!</p>
            </div>
            <div class="grid-20">
                <img src="/assets/img/thirdparty/trophy.svg" style="width: 100%">
            </div>
            <div class="grid-80">
                <h3>Learn something new</h3>

                <p>It's our hope that all participants will learn something new in the process of developing their
                    submission. Judges (and hopefully other spectators) will be watching streams and offering
                    advice on code, ideas and more. We're also trying to ensure all participants get some exposure to an
                    automated build tool (.e.g maven) by preparing a common template that will be pushed to all
                    repositories.</p>
            </div>
            <div class="grid-20">
                <img src="/assets/img/thirdparty/book.svg" style="width: 100%">
            </div>

            <div class="grid-80">
                <h3>Have fun</h3>

                <p>Above all, we're hoping ten.java will be a fun experience for everyone involved. We enjoyed judging
                    the entries last year and seeing everything that the participants came up with and are looking
                    forward to doing the same on a larger scale this year. For participants, ten.java should be a chance
                    to experiment and hopefully learn something in the process.</p>
            </div>
            <div class="grid-20">
                <img src="/assets/img/thirdparty/happy.svg" style="width: 100%">
            </div>
        </div>
    </div>
</div>
@stop