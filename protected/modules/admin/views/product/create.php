<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs=array(
	'Товары'=>array('index'),
	'Добавить',
);

$this->menu=array(
	array('label'=>'Список Товаров', 'url'=>array('index')),
);
?>

<h1>Добавить Товар</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>