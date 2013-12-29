<?php
$images = new CActiveDataProvider('Image', array(
  'criteria' => array(
    'condition' => 'product_id=' . $model->id,
  ),
  'pagination' => array(
    'pageSize' => 20,
  ),
));

// $image_id = Product::model()->findByPk($data->product_id)->image_id;

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
    /*array(
      'header' => 'Название',
      'filter' => false,
      'type' => 'raw',
      'value' => function ($data) {
        return CHTML::activeTextField($data, 'title');
      }
    ),*/
    array(
      'header' => 'Главная',
      'type' => 'raw',
      'htmlOptions' => array(
          'class' => 'button-column',
      ),
      'filter' => false,
      'value' => function ($data, $model) {
            return CHTML::radioButtonList('Product[image_id]', $data->product->image_id, array($data->id=>''));
      }
    ),
    array(
      'class' => 'CButtonColumn',
      'template' => '{delete}',
      'deleteButtonUrl' => 'Yii::app()->createUrl("/admin/product/deleteImage", array("id" => $data->id))',
    ),
  ),
));
?>