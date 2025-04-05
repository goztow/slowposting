<?php

namespace goztow\slowposting\acp;

class slowposting_module
{
    public $u_action;

    function main($id, $mode)
    {
        global $config, $request, $template, $user;

        $user->add_lang('acp/common');

        $submit = isset($_POST['submit']) ? true : false;

        if ($submit) {
            $forums = $request->variable('slowposting_forums', '', true);
            $interval = $request->variable('slowposting_interval', 24);
            set_config('slowposting_forums', $forums);
            set_config('slowposting_interval', $interval);
        }

        $template->assign_vars([
            'SLOWPOSTING_FORUMS' => $config['slowposting_forums'],
            'SLOWPOSTING_INTERVAL' => $config['slowposting_interval'],
        ]);
    }
}