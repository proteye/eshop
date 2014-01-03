<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	'Добавить',
);

$this->menu=array(
	array('label'=>'Список пользователей', 'url'=>array('index')),
);
?>

<h1>Добавить Пользователя</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>