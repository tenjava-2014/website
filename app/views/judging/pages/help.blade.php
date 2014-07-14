@extends('layouts.judging')
@section('content')
<div class="grid-container">
    <div class="grid-100">
        <article class="markdown-body js-file "
                 data-task-list-update-url="https://gist.github.com/jkcclemens/4272dfdd17ac2e7f8ff3/file/judges.md">
            <h1>
                <a name="user-content-hello-judge_name" class="anchor" href="#hello-judge_name" rel="noreferrer"><span
                        class="octicon octicon-link"></span></a>Hello, {{{ $auth->getUsername() }}}!</h1>

            <p>Welcome to your private testing server. Here are some tips to get you started.</p>

            <p>You are whitelisted and set as operator on this one-slot server. The server has 1GB of RAM. If it
                crashes, it will automatically restart. If you stop it, it will also restart.</p>

            <p>Installed on your plugin, by default, are three plugins:</p>

            <ul class="task-list">
                <li>The Remote Toolkit plugin</li>
                <li>Multiverse Core</li>
                <li>EntryPlugin</li>
            </ul>

            <p>To begin testing plugins, please get familiar with our in-house plugin to do so! It is called
                EntryPlugin. Its main command is /entry (or /e). If both of these get taken by an entry, use
                /entryplugin:entry. The entire command supports tab-completion, so use it if you get stuck.</p>

            <h2>
                <a name="user-content-downloading-plugins" class="anchor" href="#downloading-plugins"
                   rel="noreferrer"><span class="octicon octicon-link"></span></a>Downloading plugins</h2>

            <p>To download a plugin, <code>/e download</code> is used (or just <code>/e d</code> or <code>/e dl</code>).
                The syntax is as follows: <code>/e d [job_name]</code>. All of the parameters can be tab-completed. The
                <code>job_name</code> parameter is the name of the job on <a href="http://ci.tenjava.com"
                                                                             rel="noreferrer">Jenkins</a>. This supports
                tab-completion, as well.</p>

            <p>You will be restricted to the plugins you have been assigned to until you have completed judging.</p>

            <p>After downloading a plugin, a success message will be displayed. If an error is displayed, make sure that
                the job name is correct. Check out the stacktrace by clicking on the message that says "Error."</p>

            <p>Please use <code>/stop</code> to restart the server at this point, in order to load the plugin.</p>

            <h2>
                <a name="user-content-removing-plugins" class="anchor" href="#removing-plugins" rel="noreferrer"><span
                        class="octicon octicon-link"></span></a>Removing plugins</h2>

            <p>To remove a plugin, <code>/e remove</code> is used (or just <code>/e r</code> or <code>/e rm</code>). The
                syntax is as follows: <code>/e r [job_name]</code>. All of the parameters can be tab-completed. The
                <code>job_name</code> parameter is the name of the job on <a href="http://ci.tenjava.com"
                                                                             rel="noreferrer">Jenkins</a>. This supports
                tab-completion, again.</p>

            <p>After downloading a plugin, a success message will be displayed. If an error is displayed, make sure that
                the job name is correct. Check out the stacktrace by clicking on the message that says "Error."</p>

            <p>Please use <code>/stop</code> to restart the server at this point, in order to remove the plugin. You may
                wish to download a new plugin to test before restarting the server.</p>

            <h2>
                <a name="user-content-editing-configurations" class="anchor" href="#editing-configurations"
                   rel="noreferrer"><span class="octicon octicon-link"></span></a>Editing configurations</h2>

            <p>To edit configurations, <code>/e edit</code> is used (or just <code>/e e</code> or <code>/e ed</code>).
                The syntax is as follows: <code>/e e [plugin_name] [file_name] (updated_paste_url)</code>. All of the
                parameters can be tab-completed. <code>plugin_name</code> is the name of the plugin to edit files for.
                <code>file_name</code> is the name of the file to edit. If you're unsure of what file you're looking
                for, try tab-completing for a list of files. To search in directories, add a forward slash
                (<code>/</code>) to the end of a directory and press tab to get a list of files in that directory.</p>

            <p>After getting a file, you may edit it on Hastebin. The resulting Hastebin URL from the edit (which can be
                obtained by using Ctrl+D to edit, Ctrl+S to save, and Ctrl/Cmd+L and Ctrl/Cmd+C to get the URL), is then
                used as the <code>updated_paste_url</code> parameter to replace the given file name.</p>

            <h2>
                <a name="user-content-getting-the-log-file" class="anchor" href="#getting-the-log-file"
                   rel="noreferrer"><span class="octicon octicon-link"></span></a>Getting the log file</h2>

            <p>To see the log file, run <code>/e logs</code> and click the link in the chat. If you need more content,
                use <code>/e logs [size]</code>, where <code>size</code> is the number of kilobytes of scrollback you
                would like to receive. If the size is larger than the log file, you will receive the entire log file.
            </p>

            <h2>
                <a name="user-content-plugins-that-require-worlds" class="anchor" href="#plugins-that-require-worlds"
                   rel="noreferrer"><span class="octicon octicon-link"></span></a>Plugins that require worlds</h2>

            <p>If your plugin requres a world (such as world generators), Multiverse can be used. To do so, use
                Multiverse's in-game help through <code>/mv ?</code>.</p>

            <h2>
                <a name="user-content-plugins-that-require-advanced-setup" class="anchor"
                   href="#plugins-that-require-advanced-setup" rel="noreferrer"><span
                        class="octicon octicon-link"></span></a>Plugins that require advanced setup</h2>

            <p>If you need an organizer to help set up a plugin for you (e.g. MySQL), please ask in the judge IRC
                channel.</p>

        </article>
    </div>
</div>
@stop
