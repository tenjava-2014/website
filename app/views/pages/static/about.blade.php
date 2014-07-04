@extends('layouts.master')
@section('content')
<div class="grid-container">
    <div class="grid-100">
        <h2>About ten.java</h2>

        <p>Originally proposed by <a href="https://forums.bukkit.org/members/nkrecklow.43347/">nkrecklow</a>,
            ten.java is a ten hour Bukkit plugin contest/hackathon. Our first contest was held back in
            December 2013, and we had over 90 developers that signed up to take part.
        </p>

        <p>Some time after posting the <a
                href="https://forums.bukkit.org/threads/ten-java-plugin-contest-irc-esper-net-ten-java-points-4-644-http-tenjava-com-tenjava.190553/">original
                thread</a>, we decided to accept donations in the form of CurseForge points. CurseForge points are
            given to developers who submit plugins to BukkitDev, as well as addon developers who upload content to
            other CurseForge sites (covering games such as WoW, KSP, and more). These points can be redeemed for
            Amazon gift cards and PayPal payments, with each point equating to $0.05 USD.</p>

        <p>Last year, we managed to raise <a
                href="https://forums.bukkit.org/threads/ten-java-plugin-contest-irc-esper-net-ten-java-points-4-644-http-tenjava-com-tenjava.190553/page-17#post-2103998">5,488</a>
            points, which equates to just over $270 USD. On the day, participants
            streamed for up to ten hours as they developed their plugins and regularly committed their code to
            GitHub for the community to see. Participants had previously selected a time in which to participate,
            and at the start of the two time periods we released the "theme" which participants had to somehow
            incorporate into their submission. It was great being able to offer ideas and talk to those taking part,
            and it was nice to see a large majority of those taking part streaming the development process.</p>

        <p>Once the ten hours were up, we began the difficult task of judging the submissions. Not all judges were
            able to help out, so it took us a week or so to get all the submissions judged. Once we'd finished,
            we averaged the points from the judges that were able to help and announced the three winners. They
            were:</p>
        <ul>
            <li><a href="https://github.com/tenjavacontest/Vilsol">Vilsol</a></li>
            <li><a href="https://github.com/tenjavacontest/slipcor">slipcor</a></li>
            <li><a href="https://github.com/tenjavacontest/mncat77">mncat77</a></li>
        </ul>

        <h2>Plans this year</h2>

        <p>This year, we formed a new <a href="/team">team</a> and began asking for feedback on May 18, with the
            creation of a <a
                href="https://forums.bukkit.org/threads/ten-java-plugin-contest-2014-http-tenjava-com-200-signups-currently-13-530-points.269253/">new
                thread</a>. Soon after, we began to once again accept donations in the form of CurseForge points for
            the prize pot. In two weeks, we'd managed to raise over $700 to be distributed towards the winning
            participants. We spent time creating a new site with a more streamlined, automated signup system, and to
            date, we've seen over {{{ $appsData->count }}} sign-ups. </p>

        <p>We're planning to hold the contest on July 12 with 3 separate times (and thus 3 separate themes) this
            year. We've been overwhelmed by the community's response to our plans and are looking forward to the
            event itself.</p>

        <h2>Intreppid</h2>

        <p><a href="https://www.intreppid.com">Intreppid</a> was kind enough to reach out to us and offer a dedicated
            server that we will be using to build the submissions produced within the contest time. We'll be running a
            Jenkins instance and will report build information directly to our developers. Additionally, the server will
            allow us to test and judge the submissions more efficiently and host additional services, such as a voice
            server, for everyone to use.</p>

        <h2>Technical information</h2>

        <p>This site is built with <a href="http://laravel.com/">Laravel</a>, and we're utilizing <a
                href="http://nginx.org/">nginx</a> as our
            webserver. We use <a href="http://mandrill.com/">Mandrill</a> to send emails and <a
                href="http://kr.github.io/beanstalkd/">beanstalk</a> to queue long tasks and improve page
            responsiveness. Our database is powered by <a href="http://www.mysql.com/">MySQL</a>. We use the Python
            <a href="http://docs.python-requests.org/en/latest/">Requests</a> and <a
                href="http://www.crummy.com/software/BeautifulSoup/">Beautiful Soup</a> libraries to get points
            information from the CurseForge store. On the site, we use the <a
                href="https://packagist.org/packages/knplabs/github-api">knplabs/github-api</a> and <a
                href="https://github.com/thujohn/twitter-l4">thujohn/twitter-l4</a> packages. For OAuth, we use the
            <a href="https://github.com/artdarek/oauth-4-laravel">artdarek/oauth-4-laravel</a> package. To help us
            develop the site and to add auto-completion, we use the <a
                href="https://www.github.com/barryvdh/laravel-ide-helper">barryvdh/laravel-ide-helper</a> package.
            Our site code is available on <a href="https://github.com/tenjava/website">GitHub</a> for those
            interested.</p>

        <p>On the frontend, we use <a href="http://sass-lang.com/">SASS</a> (with <a
                href="http://compass-style.org/">Compass</a>) for our stylesheets and <a
                href="http://fortawesome.github.io/Font-Awesome/">Font Awesome</a> for a lot of our icons. Icons on
            the signup page are from the awesome <a href="http://iconmonstr.com">iconmonstr</a> site. We use an
            expansive <a href="http://alexwolfe.github.io/Buttons/#">button library</a> for all the buttons on the
            website. We rely on <a
                href="http://cdnjs.com/">cdnjs</a> to serve a lot of our CSS/JS. <a href="http://unsemantic.com/">Unsemantic</a>
            is what we use for fluid, responsive grids. To improve mobile responsiveness, we use <a
                href="https://github.com/ftlabs/fastclick">fastclick</a>. We also use <a href="http://jquery.com/">jQuery</a>.
            Our views are built with Laravel's <a href="http://laravel.com/docs/templates">Blade</a> templating system.
            We include a few styles via SASS from the <a href="http://ink.sapo.pt/">InK</a> interface kit. For our
            countdown timers, we've used <a href="http://git.wimbarelds.nl/TimeCircles/index.html">TimeCircles</a>.</p>

        <h3>Acknowledgements</h3>

        <p>Many thanks to <a href="https://github.com/dequis">dx</a>, <a href="https://github.com/njb-said">njb-said</a>
            and <a href="https://github.com/rigor789">rigor789</a> for contributing to the site. Additional thanks to
            the people in #laravel on Freenode for helping resolve issues relating to the site's development.</p>
    </div>
</div>
@stop
