<?php
namespace goztow\slowposting\migrations;

class install_slowposting extends \phpbb\db\migration\migration
{
    public function update_data()
    {
        return array(
            array('module.add', array(
                'acp',
                'ACP_CAT_DOT_MODS',
                'ACP_SLOWPOSTING_TITLE'
            )),
            array('module.add', array(
                'acp',
                'ACP_SLOWPOSTING_TITLE',
                array(
                    'module_basename' => '\goztow\slowposting\acp\slowposting_module',
                    'modes'           => array('settings'),
                ),
            )),
        );
    }
}