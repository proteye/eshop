<?php
$images = Image::model()->findAllByAttributes(array('product_id' => $model->id));

foreach ($images as $img) {
    echo CHtml::image($img->getImageUrl(), $data->title, array('style' => 'height: 100px;'));
}
/*
$this->widget('zii.widgets.grid.CGridView', array(
  'id' => 'image-grid',
  'dataProvider' => $images,
  'template' => "{items}",
  'columns' => array(
    array(
      'header' => 'Изображение',
      'type' => 'raw',
      'value' => function ($data) {
        return CHtml::image($data->getImageUrl(), $data->title, array('style' => 'height: 100px;'));
      }
    ),
    array(
      'header' => 'Название',
      'filter' => false,
      'value' => function ($data) {
        return $data->title;
      }
    ),
    array(
      'header' => 'Главное изображение',
      'filter' => false,
      'value' => function ($data) {
        return ($data->id == $model->id) ? 'Да' : 'Нет';
      }
    ),
    array(
      'class' => 'CButtonColumn',
      'template' => '{delete}',
      'deleteButtonUrl' => 'Yii::app()->createUrl("/admin/product/deleteImage", array("id" => $data->id))',
    ),
  ),
));
 * 
 */
?>