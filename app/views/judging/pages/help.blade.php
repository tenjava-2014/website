@extends('layouts.judging')
@section('content')
<div class="grid-container content-back">
    <div class="grid-100">
        <h1>Hello, {{{ $auth->getUsername() }}}!</h1>
        <p>Welcome to your private testing server. Here are some tips to get you started.</p>
        <p>You are whitelisted and set as operator on this one-slot server. The server has 1GB of RAM. If it crashes, it
            will automatically restart. If you stop it, it will also restart.</p>
        <p>Installed on your server, by default, are three plugins:</p>
        <ul>
            <li>The Remote Toolkit plugin</li>
            <li>Multiverse Core</li>
            <li>EntryPlugin</li>
        </ul>
        <p>To begin testing plugins, please get familiar with our in-house plugin to do so! It is called EntryPlugin.
            Its main command is /entry (or /e). If both of these get taken by an entry, use /entryplugin:entry. The
            entire command supports tab-completion, so use it if you get stuck.</p>

        <h2>Downloading plugins</h2>
        <p>To download a plugin, <code>/e download</code> is used (or just <code>/e d</code> or <code>/e dl</code>). The
            syntax is as follows: <code>/e d [job_name]</code>. All of the parameters can be tab-completed. The
            <code>job_name</code> parameter is the name of the job on <a href="http://ci.tenjava.com">Jenkins</a>. This
            supports tab-completion, as well.</p>
        <p>You will be restricted to the plugins you have been assigned to until you have completed judging.</p>
        <p>After downloading a plugin, a success message will be displayed. If an error is displayed, make sure that the
            job name is correct. Check out the stacktrace by clicking on the message that says "Error."</p>
        <p>Please use <code>/stop</code> to restart the server at this point, in order to load the plugin.</p>

        <h2>Removing plugins</h2>
        <p>To remove a plugin, <code>/e remove</code> is used (or just <code>/e r</code> or <code>/e rm</code>). The
            syntax is as follows: <code>/e r [job_name]</code>. All of the parameters can be tab-completed. The
            <code>job_name</code> parameter is the name of the job on <a href="http://ci.tenjava.com">Jenkins</a>. This
            supports tab-completion, again.</p>
        <p>After downloading a plugin, a success message will be displayed. If an error is displayed, make sure that the
            job name is correct. Check out the stacktrace by clicking on the message that says "Error."</p>
        <p>Please use <code>/stop</code> to restart the server at this point, in order to remove the plugin. You may
            wish to download a new plugin to test before restarting the server.</p>

        <h2>Editing configurations</h2>
        <p>To edit configurations, <code>/e edit</code> is used (or just <code>/e e</code> or <code>/e ed</code>). The
            syntax is as follows: <code>/e e [plugin_name] [file_name] (updated_paste_url)</code>. All of the required
            parameters can be tab-completed. <code>plugin_name</code> is the name of the plugin to edit files for.
            <code>file_name</code> is the name of the file to edit. If you're unsure of what file you're looking for,
            try tab-completing for a list of files. To search in directories, add a forward slash (<code>/</code>) to
            the end of a directory and press tab to get a list of files in that directory.</p>
        <p>After getting a file, you may edit it on Hastebin. The resulting Hastebin URL from the edit (which can be
            obtained by using Ctrl+D to edit, Ctrl+S to save, and Ctrl/Cmd+L and Ctrl/Cmd+C to get the URL), is then
            used as the <code>updated_paste_url</code> parameter to replace the given file name.</p>

        <h2>Getting the log file</h2>
        <p>To see the log file, <code>/e logs</code> is used (or just <code>/e l</code> or <code>/e log</code>). The
            syntax is as follows: <code>/e l (size)</code>. Once the command has been run, click the link in the chat to
            see the server log. If you need more content, use <code>/e logs (size)</code>, where <code>size</code> is
            the number of kilobytes of scrollback you would like to receive. If the size is larger than the log file,
            you will receive the entire log file.</p>

        <h2>Plugins that require worlds</h2>
        <p>If your plugin requires a world (such as world generators), Multiverse can be used. To do so, use
            Multiverse's in-game help through <code>/mv ?</code>.</p>

        <h2>Plugins that require advanced setup</h2>
        <p>If you need an organizer to help set up a plugin for you (e.g. MySQL), please ask in the judge IRC
            channel.</p>

        <h2>Server issues</h2>
        <p>If your server freezes or breaks, please let an organizer know so we can restart your server. If no organizer
            is available, the server will automatically restart after five minutes of no responses from the heartbeat
            plugin. Additionally, if you can narrow down these issues to a specific plugin, you may wish to look further
            into the problem, as it may influence final scores.</p>
    </div>
</div>
@stop
