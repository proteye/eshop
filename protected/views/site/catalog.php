<?php
if ($categories) {
    $this->widget('zii.widgets.CMenu',array(
        'items'=>$categories,
        'activateItems'=>false,
    ));
}
elseif ($products) {
    foreach ($products as $product) {
        echo CHtml::image(Yii::app()->getBaseUrl(true) . $product::UPLOAD_FOLDER . $product->main_image->name,'',array('width'=>'40%'));
        echo '<br/><br/>Описание:<br/>' . $product->description;
        echo 'Цена: ' . $product->price . ' руб.';
    }
}
?>
