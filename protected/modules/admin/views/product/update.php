<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs=array(
	'Товары'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Изменить',
);

$this->menu=array(
	array('label'=>'Список Товаров', 'url'=>array('index')),
	array('label'=>'Добавить Товар', 'url'=>array('create')),
	array('label'=>'Просмотр Товара', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Изменить Товар #<?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>