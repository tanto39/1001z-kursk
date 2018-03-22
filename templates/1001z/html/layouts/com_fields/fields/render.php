<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_fields
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

// Check if we have all the data
if (!key_exists('item', $displayData) || !key_exists('context', $displayData))
{
	return;
}

// Setting up for display
$item = $displayData['item'];

if (!$item)
{
	return;
}

$context = $displayData['context'];

if (!$context)
{
	return;
}

JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php');

$parts     = explode('.', $context);
$component = $parts[0];
$fields    = null;

if (key_exists('fields', $displayData))
{
	$fields = $displayData['fields'];
}
else
{
	$fields = $item->jcfields ?: FieldsHelper::getFields($context, $item, true);
}

if (!$fields)
{
	return;
}
?>

<?php foreach ($fields as $field) : ?>

	<?php // If the value is empty do nothing
	if (!isset($field->value) or $field->value == '') :
		continue;
	endif; ?>

    <?php if ($field->name == 'price'):?>
        <div class="price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">Цена:
            <span itemprop="price"><?=$field->value?></span>
            <?php if ($field->value == 'не указано'):?><span>руб.</span><?php endif?>
            <meta itemprop="priceCurrency" content="RUB">
        </div>
    <?php elseif($field->name != 'product-img' && $field->name != 'product-img-2' && $field->name != 'product-img-3'):?>
        <?php $class = $field->params->get('render_class'); ?>
        <dd class="field-entry <?php echo $class; ?>">
            <?php echo FieldsHelper::render($context, 'field.render', array('field' => $field)); ?>
        </dd>
    <?php endif;?>
<?php endforeach;?>

<div class="detail-image-big-wrap"></div>
<div class="detail-image-small-block flex">
    <?php foreach ($fields as $field) : ?>
        <?php // If the value is empty do nothing
        if (!isset($field->value) or $field->value == '') :
            continue;
        endif; ?>

        <?php if($field->name == 'product-img' || $field->name == 'product-img-2' || $field->name == 'product-img-3') : ?>
            <a class="detail-image-small-item flex <?if($field->name == 'product-img'):?>active<?endif?>" href="/<?=$field->rawvalue?>" data-original-src="/<?=$field->rawvalue?>" data-full-src="/<?=$field->rawvalue?>" onclick="enterShop.changePicture($(this).data('original-src'), $('.detail-image-big-img'), $(this), event)">
                <img class="detail-image-small-item-img" src="<?=$field->rawvalue?>" alt=""/>
            </a>
        <?php endif; ?>
    <?php endforeach;?>
</div>
