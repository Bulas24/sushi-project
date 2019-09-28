<?php $parent_id = \ishop\App::$app->getProperty('brand_id');?>
<option value="<?=$id;?>"<?php if ($id == $parent_id) echo 'selected';?>>
    <?=$tab . $brands['title'];?>
</option>

