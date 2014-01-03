<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Список пользователей', 'url'=>array('index')),
	array('label'=>'Добавить пользователя', 'url'=>array('create')),
	array('label'=>'Изменить пользователя', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить пользователя', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены, что хотите удалить данный элемент?')),
);
?>

<h1>Просмотр Пользователя #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'login',
		// 'password',
                array(
                    'name' => 'role_id',
                    'value' => $model->role->description,
                ),
		'name',
		'email',
		'phone',
		'address',
                array(
                    'name' => 'created',
                    'value' => date("j.m.Y G:i:s", $model->created),
                ),
                array(
                    'name' => 'status',
                    'value' => ($model->status == 1) ? "Да" : "Нет",
                ),
	),
)); ?>
