<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	'Категории'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Изменить',
);

$this->menu=array(
	array('label'=>'Список Категорий', 'url'=>array('index')),
	array('label'=>'Добавить Категорию', 'url'=>array('create')),
	array('label'=>'Просмотр Категории', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Изменить Категорию #<?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>