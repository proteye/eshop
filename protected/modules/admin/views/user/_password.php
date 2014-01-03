<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Изменить пароль',
);

$this->menu=array(
	array('label'=>'Список пользователей', 'url'=>array('index')),
	array('label'=>'Добавить пользователя', 'url'=>array('create')),
	array('label'=>'Просмотр пользователя', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Изменить пароль</h1>

<?php
echo CHtml::beginForm();
echo CHtml::errorSummary($model);
echo CHtml::label('Введите пароль', 'User_password') . '<br/>';
echo CHtml::passwordField('User[password]') . '<br/>';
echo CHtml::error($model, 'password') . '<br/>';;
echo CHtml::label('Подтвердите пароль', 'User_confirm_password') . '<br/>';
echo CHtml::passwordField('User[confirm_password]') . '<br/>';
echo CHtml::error($model, 'confirm_password') . '<br/>';
echo CHtml::submitButton('Изменить');
echo CHtml::endForm();
?>