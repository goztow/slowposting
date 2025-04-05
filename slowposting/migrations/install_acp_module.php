<?php
/**
 *
 * Slow posting. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2025, Goztow, https://userbase.be
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace goztow\slowposting\migrations;

class install_acp_module extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['goztow_slowposting_goodbye']);
	}

	public static function depends_on()
	{
		return ['\phpbb\db\migration\data\v320\v320'];
	}

	public function update_data()
	{
		return [
			['config.add', ['goztow_slowposting_goodbye', 0]],

			['module.add', [
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_SLOWPOSTING_TITLE'
			]],
			['module.add', [
				'acp',
				'ACP_SLOWPOSTING_TITLE',
				[
					'module_basename'	=> '\goztow\slowposting\acp\main_module',
					'modes'				=> ['settings'],
				],
			]],
		];
	}
}
