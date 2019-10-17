<?php $parent = isset($category['childs']); ?>

    <p class="item-p">
        <a class="list-group-item" href="<?=MANAGER;?>/category"><?=$category['title'];?></a>
    </p>

<?php if ($parent): ?>
    <div class="list-group">
        <?=$this->getMenuHtml($category['childs']); ?>
    </div>
<?php endif;?>