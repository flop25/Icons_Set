<?php

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

global $template, $conf, $user;

load_language('plugin.lang', ICONSET_PATH);
$page['infos'] = array();


if (isset($_POST['envoi_config']) and $_POST['envoi_config']=='iconset')
{
	check_pwg_token();
}
////////////////////////////////////////////////
////////[ liste les icones dispo  ]    //////////
// RQ : un set d'icone = chemin vers le *.conf.php ; on associe (ou pas) un fichier *.conf.php par thème
////////////////////////////////////////////////
function get_list_iconconf_path ($dir) {
	static $list_iconconf_path=array();
	$dh = opendir ($dir);
	while (($file = readdir ($dh)) !== false ) {
		if ($file !== '.' && $file !== '..') {
			$path =$dir.'/'.$file;
			if (is_dir ($path)) { 
				get_list_iconconf_path ($path);
			}
			else
			{
				$page = explode('.', $file);
				$nb = count($page);
				$nom_fichier = $page[0];
				for ($i = 1; $i < $nb-1; $i++){
				 $nom_fichier .= '.'.$page[$i];
				}
				if(isset($page[1])){
				 $ext_fichier = $page[$nb-2].'.'.$page[$nb-1];
				}
				else {
				 $ext_fichier = '';
				}
			
				if($ext_fichier == 'conf.php') { //On ne prend que les .conf.php
					$path = str_replace("./plugins/Icons_Set/icons/", "", $path);
					$list_iconconf_path[]=$path;
				}
			}
		}
	}
	closedir ($dh);
	return $list_iconconf_path;
}	

function check_config()
{
	global $conf, $prefixeTable, $page;
	$conf_iconset = @unserialize($conf['iconset']);//pwg_db_real_escape_string(serialize($conf_iconset))
	include_once(PHPWG_ROOT_PATH.'admin/include/themes.class.php');
	$themes = new themes();
	$all_icons=get_list_iconconf_path ('./plugins/Icons_Set/icons');
	if ( !isset($conf_iconset) or empty($conf_iconset) or !is_array($conf_iconset) )
	{
		$conf['iconset']=array(
		'themes'=>array(),
		'icons'=>array()
		);
	}
	$themes->sort_fs_themes();
	$conf_themes=$conf_iconset['themes'];
	$conf_icons=$conf_iconset['icons'];
	$list_theme_id=array();
	$info_new_theme='';
	$info_new_icon='';
	$info_deleted_theme='';
	$info_deleted_icon='';
	foreach ($themes->fs_themes as $theme_id => $fs_theme)
	{
    if  ((isset($fs_theme['activable']) and !$fs_theme['activable']) or $theme_id == 'default' )
		{
			continue;
		}
		if (!array_key_exists($fs_theme['id'], $conf_themes)) // theme ajouté
		{
			$info_new_theme.=$theme_id.'<br>';
			$conf_themes[$theme_id]=''; // RAZ
		}
		if (!empty($conf_themes[$theme_id]) and !in_array($conf_themes[$theme_id], $all_icons))  //  association thème/icon supprimée
		{
			$info_deleted_icon.=$conf_themes[$theme_id].'<br>';
			$conf_themes[$theme_id]=''; // RAZ
		}
		$list_theme_id[]=$theme_id;
	}
	foreach ($conf_themes as $theme_id => $iconset) // theme supprimé
	{
		if (!in_array($theme_id, $list_theme_id))
		{
			$info_deleted_theme.=$theme_id.'<br>';
			unset($conf_themes[$theme_id]);// suppression de sa config
		}
	}
	foreach ($all_icons as $iconset) // icones ajoutées
	{
		if (!in_array($iconset, $conf_icons))
		{
			$info_new_icon.=$iconset.'<br>';
		}
	}
	$conf['iconset']=array(
		'themes'=>$conf_themes,
		'icons'=>$all_icons
		);
  $query = '
    UPDATE '.CONFIG_TABLE.'
    SET value="'.pwg_db_real_escape_string(serialize($conf['iconset'])).'"
    WHERE param="iconset"
    LIMIT 1';
  pwg_query($query);
	if (!empty($info_new_theme)) { 	array_push($page['infos'], l10n('iconset_info_new_theme').$info_new_theme );	 }
	if (!empty($info_new_icon)) { 	array_push($page['infos'], l10n('iconset_info_new_icon').$info_new_icon );	 }
	if (!empty($info_deleted_theme)) { 	array_push($page['infos'], l10n('iconset_info_deleted_theme').$info_deleted_theme );	 }
	if (!empty($info_deleted_icon)) { 	array_push($page['infos'], l10n('iconset_info_deleted_icon').$info_deleted_icon );	 }
}
check_config();
load_conf_from_db();
$conf_iconset = @unserialize($conf['iconset']);//pwg_db_real_escape_string(serialize($conf_iconset))
$conf_themes=$conf_iconset['themes'];
$conf_icons=$conf_iconset['icons'];
include_once(PHPWG_ROOT_PATH.'admin/include/themes.class.php');
$themes = new themes();
$themes->sort_fs_themes();
$all_themes=array();
foreach ($conf_themes as $theme_id => $iconset)
{
	$all_themes[$theme_id]=array(
	'name'=>$themes->fs_themes[$theme_id]['name'],
	'id'=>$themes->fs_themes[$theme_id]['id'],
	'screenshot'=>$themes->fs_themes[$theme_id]['screenshot'],
	'icon'=>$iconset,
	);
}

$all_icons=array();
$values=array();
$output=array();
foreach ($conf_icons as $iconset)
{
	include_once('icons/'.$iconset);
	$all_icons[]=array(
	'path'=>$iconset,
  'name' => $iconsetconf['name'],
  'id' => $iconsetconf['id'],
  'icon_file' => $iconsetconf['icon_file'],
  'css_file' => $iconsetconf['css_file'],
	);
	$values[]=$iconset;
	$output[]=$iconsetconf['name'];
}
$template->assign(array(
  'all_themes' => $all_themes,
  'all_icons' => $all_icons,
  'values' => $values,
  'output' => $output,
));

$template->assign(array(
  'PWG_TOKEN' => get_pwg_token()
));

$template->func_combine_css(array(
	'path' => 'plugins/'.ICONSET_DIR.'/template/admin.css',
	),
	$smarty
);
$template->set_filename('plugin_admin_content', dirname(__FILE__) .'/template/admin.tpl');
$template->assign_var_from_handle('ADMIN_CONTENT', 'plugin_admin_content');

?>