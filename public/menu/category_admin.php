<?php $parent = isset($category['childs']); ?>
<?php
if (!$parent){
    $delete = '<a href="'.ADMIN.'/category/delete?id=' .$id. '" class="delete">
<i class="fa fa-fw fa-remove text-danger"></i>
</a>';
}else{
    $delete = '<i class="fa fa-fw fa-remove text-gray"></i>';
}
?>

<p class="item-p">
    <a class="list-group-item" href="<?=ADMIN;?>/category/edit?id=<?=$id;?>"><?=$category['title'];?></a>
    <span><?=$delete;?></span>
</p>

<?php if ($parent): ?>
    <div class="list-group">
        <?=$this->getMenuHtml($category['childs']); ?>
    </div>
<?php endif;?>
