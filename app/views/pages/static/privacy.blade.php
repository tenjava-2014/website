@extends('layouts.master')
@section('content')
<div class="content-back">
    <div class="grid-container">
        <div class="grid-100">
            <h2>Privacy info</h2>

            <p>When you sign up as a participant or apply as a judge, we use GitHub to collect some information from
                you. We use the 'user:email' scope by default, which gives us a list of email addresses from your GitHub
                account. This includes non-primary emails. We use this data for a number of purposes:</p>
            <ul>
                <li>Sending acceptance/rejection emails to users who have applied to be a judge.</li>
                <li>Sending information about action required by participants.</li>
                <li>Sending results information.</li>
            </ul>
            <p>We'll also need to use this information if we need to get in contact with a participant due to confusion
                over code origin or if other issues become apparent. This data can only be seen by users in the 'admin'
                group – this is currently the organizers of the contest. See <a href="/judges">this</a> page for more
                info. Email data will
                not be shared with any third parties.</p>

            <p>We also request additional information from participants and judges. Participants will be asked to
                provide a BukkitDev username (we need to be able to transfer the prize in CurseForge points) and
                optionally, a Twitch username. By providing this data you agree to allow us to make it publicly
                available on the website, Twitter page, or otherwise. If you choose to stream, you agree to allow us to
                display a thumbnail and channel status on the site. We do not require participants to provide a Twitch
                username.</p>

            <p>We ask judges to provide an IRC nick, GMail address, and Minecraft username. This is in addition to a
                BukkitDev username. The IRC nick will be used to invite you to our communication channel(s) if your
                application is successful. We'll use the GMail address to invite you to any documents or spreadsheets if
                your application is successful. Your Minecraft username will be checked for validity and used to allow
                you to use our testing server(s). For participants and judges, the GitHub username used to authenticate
                the application will also be stored.</p>

            <p>All judges have limited access to applicant/participant data. Judges can see GitHub, BukkitDev,
                Minecraft, IRC and, twitch.tv (if supplied) usernames. Judges cannot see GMail addresses and cannot see
                GitHub emails. Organizers (as listed on the judges page) can see this information.</p>

            <h2>Email access</h2>

            <p>To ensure applicants and participants have a choice about what information they choose to provide, we
                have made it possible to opt-out of email sharing. If you choose to opt-out, we will not have access to
                your GitHub emails. This applies to participants and judge applications. Judge applicants must still
                provide a GMail address to be considered. To opt-out, simply use the link below:</p>

            <p>
                <strong>Current opt-out status:</strong>
                {{ ($emailOptOut) ? "You are opted out." : "You are <em>not</em> opted out." }}
            </p>

            <p>
                <a class="button {{ (!$emailOptOut) ? "button-flat-action" : "button-flat-primary" }}" href="/toggle-optout">
                    {{ ($emailOptOut) ? "Opt in" : "Opt out" }}
                </a>
            </p>
        </div>
    </div>
</div>
@stop