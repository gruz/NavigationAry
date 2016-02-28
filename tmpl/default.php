<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_navigationary
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$lang = JFactory::getLanguage();
?>

	<ul class="pager pagenav navigationary">
	<?php if ($prev->flink) :
		$direction = $lang->isRtl() ? 'right' : 'left'; ?>
		<li class="previous">
			<a href="<?php echo $prev->flink; ?>" rel="prev">
				<?php echo '<span class="icon-chevron-' . $direction . '"></span> ' . $prev->label; ?>
			</a>
		</li>
	<?php endif; ?>
	<?php if ($next->flink) :
		$direction = $lang->isRtl() ? 'left' : 'right'; ?>
		<li class="next">
			<a href="<?php echo $next->flink; ?>" rel="next">
				<?php echo $next->label . ' <span class="icon-chevron-' . $direction . '"></span>'; ?>
			</a>
		</li>
	<?php endif; ?>
	</ul>

