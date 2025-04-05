<?php
/**
 *
 * Slow posting. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2025, Goztow, https://userbase.be
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace goztow\slowposting\acp;

/**
 * Slow posting ACP module info.
 */
class main_info
{
	public function module()
	{
		return [
			'filename'	=> '\goztow\slowposting\acp\main_module',
			'title'		=> 'ACP_SLOWPOSTING_TITLE',
			'modes'		=> [
				'settings'	=> [
					'title'	=> 'ACP_SLOWPOSTING',
					'auth'	=> 'ext_goztow/slowposting && acl_a_board',
					'cat'	=> ['ACP_SLOWPOSTING_TITLE'],
				],
			],
		];
	}
}
