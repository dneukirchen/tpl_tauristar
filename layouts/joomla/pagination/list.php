<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

$list = $displayData['list'];

if (!isset($paginationClass))
{
	$paginationClass = '';
}
?>
<ul class ="<?php echo $paginationClass; ?>">
	<li class="pagination-start"><?php echo $list['start']['data']; ?></li>
	<li class="pagination-prev"><?php echo $list['previous']['data']; ?></li>
	<?php
	foreach ($list['pages'] as $page)
	{
		echo '<li>' . $page['data'] . '</li>';
	}
	?>
	<li class="pagination-next"><?php echo $list['next']['data']; ?></li>
	<li class="pagination-end"><?php echo $list['end']['data']; ?></li>
</ul>
