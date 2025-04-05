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

class install_sample_data extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return $this->config->offsetExists('goztow_slowposting_sample_int');
	}

	public static function depends_on()
	{
		return ['\phpbb\db\migration\data\v320\v320'];
	}

	/**
	 * Add, update or delete data stored in the database during extension installation.
	 *
	 * https://area51.phpbb.com/docs/dev/3.2.x/migrations/data_changes.html
	 *  config.add: Add config data.
	 *  config.update: Update config data.
	 *  config.remove: Remove config.
	 *  config_text.add: Add config_text data.
	 *  config_text.update: Update config_text data.
	 *  config_text.remove: Remove config_text.
	 *  module.add: Add a new CP module.
	 *  module.remove: Remove a CP module.
	 *  permission.add: Add a new permission.
	 *  permission.remove: Remove a permission.
	 *  permission.role_add: Add a new permission role.
	 *  permission.role_update: Update a permission role.
	 *  permission.role_remove: Remove a permission role.
	 *  permission.permission_set: Set a permission to Yes or Never.
	 *  permission.permission_unset: Set a permission to No.
	 *  custom: Run a callable function to perform more complex operations.
	 *
	 * @return array Array of data update instructions
	 */
	public function update_data()
	{
		return [
			// Add new config table settings
			['config.add', ['goztow_slowposting_sample_int', 0]],
			['config.add', ['goztow_slowposting_sample_str', '']],

			// Add a new config_text table setting
			['config_text.add', ['goztow_slowposting_sample', '']],

			// Add new permissions
			['permission.add', ['a_new_goztow_slowposting']], // New admin permission
			['permission.add', ['m_new_goztow_slowposting']], // New moderator permission
			['permission.add', ['u_new_goztow_slowposting']], // New user permission

			// ['permission.add', ['a_copy', true, 'a_existing']], // New admin permission a_copy, copies permission settings from a_existing

			// Set our new permissions
			['permission.permission_set', ['ROLE_ADMIN_FULL', 'a_new_goztow_slowposting']], // Give ROLE_ADMIN_FULL a_new_goztow_slowposting permission
			['permission.permission_set', ['ROLE_MOD_FULL', 'm_new_goztow_slowposting']], // Give ROLE_MOD_FULL m_new_goztow_slowposting permission
			['permission.permission_set', ['ROLE_USER_FULL', 'u_new_goztow_slowposting']], // Give ROLE_USER_FULL u_new_goztow_slowposting permission
			['permission.permission_set', ['ROLE_USER_STANDARD', 'u_new_goztow_slowposting']], // Give ROLE_USER_STANDARD u_new_goztow_slowposting permission
			['permission.permission_set', ['REGISTERED', 'u_new_goztow_slowposting', 'group']], // Give REGISTERED group u_new_goztow_slowposting permission
			['permission.permission_set', ['REGISTERED_COPPA', 'u_new_goztow_slowposting', 'group', false]], // Set u_new_goztow_slowposting to never for REGISTERED_COPPA

			// Add new permission roles
			['permission.role_add', ['slowposting admin role', 'a_', 'a new role for admins']], // New role "slowposting admin role"
			['permission.role_add', ['slowposting moderator role', 'm_', 'a new role for moderators']], // New role "slowposting moderator role"
			['permission.role_add', ['slowposting user role', 'u_', 'a new role for users']], // New role "slowposting user role"

			// Call a custom callable function to perform more complex operations.
			['custom', [[$this, 'sample_callable_install']]],
		];
	}

	/**
	 * Add, update or delete data stored in the database during extension un-installation (purge step).
	 *
	 * IMPORTANT: Under normal circumstances, the changes performed in update_data will
	 * automatically be reverted during un-installation. This revert_data method is optional
	 * and only needs to be used to perform custom un-installation changes, such as to revert
	 * changes made by custom functions called in update_data.
	 *
	 * https://area51.phpbb.com/docs/dev/3.2.x/migrations/data_changes.html
	 *  config.add: Add config data.
	 *  config.update: Update config data.
	 *  config.remove: Remove config.
	 *  config_text.add: Add config_text data.
	 *  config_text.update: Update config_text data.
	 *  config_text.remove: Remove config_text.
	 *  module.add: Add a new CP module.
	 *  module.remove: Remove a CP module.
	 *  permission.add: Add a new permission.
	 *  permission.remove: Remove a permission.
	 *  permission.role_add: Add a new permission role.
	 *  permission.role_update: Update a permission role.
	 *  permission.role_remove: Remove a permission role.
	 *  permission.permission_set: Set a permission to Yes or Never.
	 *  permission.permission_unset: Set a permission to No.
	 *  custom: Run a callable function to perform more complex operations.
	 *
	 * @return array Array of data update instructions
	 */
	public function revert_data()
	{
		return [
			['custom', [[$this, 'sample_callable_uninstall']]],
		];
	}

	/**
	 * A custom function for making more complex database changes
	 * during extension installation. Must be declared as public.
	 */
	public function sample_callable_install()
	{
		// Run some SQL queries on the database
	}

	/**
	 * A custom function for making more complex database changes
	 * during extension un-installation. Must be declared as public.
	 */
	public function sample_callable_uninstall()
	{
		// Run some SQL queries on the database
	}
}
