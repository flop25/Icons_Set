<?php

function plugin_install()
{
    global $prefixeTable;
    $q = '
INSERT INTO ' . CONFIG_TABLE . ' (param,value,comment)
	VALUES
	("iconset" , "" , "List of icons and their associations with themes");';
    pwg_query($q);

}



function plugin_activate()
{
    global $prefixeTable;
}//fin active




function plugin_uninstall()
{
	global $prefixeTable;
  pwg_query('DELETE FROM '.CONFIG_TABLE.' WHERE param IN (\'iconset\')');
}//fin uninstall


?>