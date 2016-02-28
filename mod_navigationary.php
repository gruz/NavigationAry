<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_navigationary
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

            //~ $router = JSite::getRouter();// get router
            //~ $juri = JURI::getInstance();
            //~ $query = $router->parse($juri); // Get the real joomla query as an array - parse current joomla link
//~ dump ($query,'$query');
            //~ $module->content =  $url = 'index.php?'.JURI::getInstance()->buildQuery($query);

	$base_uri = JURI::getInstance()->base();
	$current_path = JURI::getInstance()->toString();
	$current_path = str_replace($base_uri,'/',$current_path);
	// Get default menu - JMenu object, look at JMenu api docs
	$menu = JFactory::getApplication()->getMenu();

	// get active menu
	$active   = $menu->getActive();
//dump ($active,'$active');
	if(!isset($active->flink)) {$active->flink = JRoute::_($active->link,false);}

	if ($params->get('only_main_level',1)) {
		if ($current_path != $active->flink) {	return; } // Make it work only at main link, i.e. at blog which is a menu item, but not a child article
	}
	$k = 'menutype'; $attributes[$k] = $active->{$k};
	$k = 'parent_id'; $attributes[$k] = $active->{$k};
	$k = 'level'; $attributes[$k] = $active->{$k};

//dump ($attributes,'$attributes');
	// Get menu items - array with menu items
	$items = $menu->getItems(array_keys($attributes),$attributes);
	//$items = $menu->getItems(null,null);
	//$items = $menu->getMenu();
//dump ($items,'$items');

	$prev = new stdClass; $prev->flink = false;
	$next = new stdClass; $next->flink = false;

	$passed_active_id=false;
	//~ foreach ($items as $k=>$v) {
//~ dump ($v,$v->id);
	//~ }
	foreach ($items as $k=>$v) {
//dump ($active->id,$v->id);
		if ($v->id != $active->id && !$passed_active_id) {
			$prev = $v;
		}
		if ($v->id == $active->id) {
			$passed_active_id = true;
			continue;
		}
		if ($passed_active_id) {
			$next = $v;
			break;
		}
	}


	if(!isset($prev->flink)) {$prev->flink = JRoute::_($prev->link.'&Itemid='.$prev->id,false);}
	if ($prev->flink) {
		$prev->label = $prev->title;
	}
	if(!isset($next->flink)) {$next->flink = JRoute::_($next->link.'&Itemid='.$next->id,false);}
	if ($next->flink) {
		$next->label = $next->title;
	}

//dump ($prev,' prev '.@$prev->id);
//dump ($next,'next '.@$next->id);

$moduleclass_sfx = htmlspecialchars('navigationary'.$params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_navigationary', $params->get('layout', 'default'));
