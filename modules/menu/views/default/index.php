<div class="menu-default-index">
    <div class="tm-root">
        <?= $treemenu; ?>
    </div>
</div>

<?php
$js = <<<JS
jQuery('.tm-root li').on('click',function(e){
    if(e.target == this){
        jQuery(this).next('ul').toggleClass('tm-hidden');
    }
});
JS;
$this->registerJs($js);
