<?php
/*
Plugin Name: Icons Set
Version: auto
Description: Allow you to use other icons for any themes
Plugin URI: http://phpwebgallery.net/ext/extension_view.php?eid=527
Author: Flop25
Author URI: http://www.planete-flop.fr/
*/

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
define('ICONSET_DIR' , basename(dirname(__FILE__)));
define('ICONSET_PATH' , PHPWG_PLUGINS_PATH . ICONSET_DIR . '/');
define('ICONS_PATH' , PHPWG_PLUGINS_PATH . ICONSET_DIR . '/icons/');

add_event_handler('get_admin_plugin_menu_links', 'iconset_admin_menu');
function iconset_admin_menu($menu)
{
  global $conf;

  array_push($menu, array(
    'NAME' => 'Icons Set',
    'URL' => get_root_url().'admin.php?page=plugin-'.ICONSET_DIR
    )
  );
  return $menu;
}
add_event_handler('loc_after_page_header', 'load_set');
function load_set()
{
	if (!defined('IN_ADMIN') or !IN_ADMIN)
	{
		global $template, $user, $conf;
		$conf_iconset = @unserialize($conf['iconset']);//pwg_db_real_escape_string(serialize($conf_iconset))
		$conf_themes=$conf_iconset['themes'];
		$conf_icons=$conf_iconset['icons'];
		if (isset($user['theme']) and is_array($conf_themes) and array_key_exists($user['theme'], $conf_themes) and !empty($conf_themes[$user['theme']]) and file_exists(ICONS_PATH.$conf_themes[$user['theme']]) )
		{
			include ICONS_PATH.$conf_themes[$user['theme']];
			$template->func_combine_css(array(
				'path' => $iconsetconf['css_file'],
				'order' => 100,
				)
			);
		}
	}


}
?>