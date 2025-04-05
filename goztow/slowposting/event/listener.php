<?php

namespace goztow\slowposting\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
    protected $db;
    protected $user;
    protected $request;
    protected $config;
    protected $time;

    public function __construct(
        \phpbb\db\driver\driver_interface $db,
        \phpbb\user $user,
        \phpbb\request\request_interface $request,
        \phpbb\config\config $config,
        $time
    ) {
        $this->db = $db;
        $this->user = $user;
        $this->request = $request;
        $this->config = $config;
        $this->time = $time;
    }

    public static function getSubscribedEvents()
    {
        return [
            'core.submit_post_before' => 'check_slow_posting',
        ];
    }

    public function check_slow_posting($event)
    {
        $forum_id = $event['forum_id'];
        $topic_id = $event['data']['topic_id'];
        $user_id = (int) $this->user->data['user_id'];

        $enabled_forums = explode(',', $this->config['slowposting_forums']);
        $interval = (int) $this->config['slowposting_interval'];

        if ($user_id <= 1 || !in_array($forum_id, $enabled_forums)) {
            return;
        }

        $sql = 'SELECT post_time FROM ' . POSTS_TABLE . '
                WHERE topic_id = ' . (int) $topic_id . '
                AND poster_id = ' . $user_id . '
                ORDER BY post_time DESC';
        $result = $this->db->sql_query_limit($sql, 1);
        $last_post_time = $this->db->sql_fetchfield('post_time');
        $this->db->sql_freeresult($result);

        if ($last_post_time && ($this->time - $last_post_time) < $interval * 3600) {
			$next_post_time = $last_post_time + ($interval * 3600);
			$readable_time = $this->user->format_date($next_post_time, 'd M Y H:i');
			trigger_error(sprintf($this->user->lang('SLOW_POSTING_LIMIT'), $readable_time));
		}
    }
}