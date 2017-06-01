<div class="menu-default-index col-xs-12">
    <div class="tm-root col-xs-6">
        <?= $treemenu; ?>
    </div>
    <div class="tm-root-menu col-xs-6">
        <?= $treemenu; ?>
    </div>
</div>

<?php
$js = <<<JS
jQuery('.tm-root a').on('click',function(e){
    if(e.target == this){
        jQuery(this).next('ul').toggleClass('tm-hidden');
    }
});
JS;
$this->registerJs($js);
