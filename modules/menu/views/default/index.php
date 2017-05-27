<div class="menu-default-index">
    <div class="col-xs-6">

    </div>
    <div class="col-xs-6">
        <pre>
<?php
var_dump($model);
?>
        </pre>
    </div>
</div>

<?php
$js = <<<JS

JS;

$this->registerJS($js);
