<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$uri = preg_replace("/\?.*/i",'', $_SERVER['REQUEST_URI']);
?>

<?php foreach ($list as $item):?>
	<?php $images = json_decode($item->images) ; // декодируем данные о рисунке?>
	<div class="left-news-block">
		<?php if (isset($images->image_intro) and !empty($images->image_intro)):?>
			<div class="left-news-img">
			
			<?php if ($uri != $item->link):?>
				<a href="<?php echo $item->link; ?>">
            <?php else:?>
				<a href="#">
            <?php endif;?>
				
			<img alt="<?php echo $item->title; ?>" title="<?php echo $item->title; ?>" src="<?php echo htmlspecialchars($images->image_intro); ?>"/></a>
			
			</div>
		<?php endif;?>
		<div class="text-center left-news-desc">
		
		<?php if ($uri != $item->link):?>
			<a href="<?php echo $item->link; ?>">
		<?php else:?>
			<a href="#">
		<?php endif;?>
			
			<?php echo $item->title; ?></a>
		</div>
	</div>
<?php endforeach; ?>