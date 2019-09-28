<?php $parent_id = \ishop\App::$app->getProperty('parent_id');?>
<option value="<?=$id;?>"<?php if ($id == $parent_id) echo 'selected';?>>
    <?=$tab . $category['title'];?>
</option>
<?php if (isset($category['childs'])): ?>
    <?=$this->getMenuHtml($category['childs'], '&nbsp;' . $tab . '-'); ?>
<?php endif;?>
