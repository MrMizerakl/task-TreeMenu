<div class="menu-default-index">
    <div class="col-xs-6">
        <div id="tm-root"></div>
    </div>
    <div class="col-xs-6">
      
    </div>
</div>

<?php

$arr = json_encode($model);

$js = <<<JS
'use strict'
let items = $arr;
items.forEach(function(item){
    let parent = item.parent ? jQuery('#tm-item-'+item.parent) : jQuery('#tm-root');
    let nelm = '<div id="tm-item-' + item.id + '" ' + (item.isgroup=='1' ? ' class="tm-parent ' + (item.parent ? 'tm-hidden':'')  + '" ': ' class="tm-hidden" ') + '>'+ item.name+ ( item.url ? '&nbsp;<span class="tm-url">' + item.url + '</span>' : '') +'</div>';
    jQuery(parent).append( jQuery(nelm) );
});
jQuery('.tm-parent').on('click',function(e){
   e.preventDefault();
   if( e.target == this ){
        $(this).children().toggleClass('tm-hidden');
   }
});
JS;

$this->registerJS($js);
