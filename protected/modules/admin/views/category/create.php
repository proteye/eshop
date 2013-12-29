<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	'Категории'=>array('index'),
	'Добавить',
);

$this->menu=array(
	array('label'=>'Список Категорий', 'url'=>array('index')),
);
?>

<h1>Добавить Категорию</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>