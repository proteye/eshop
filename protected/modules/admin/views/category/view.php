<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	'Категории'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Список Категорий', 'url'=>array('index')),
	array('label'=>'Добавить Категорию', 'url'=>array('create')),
	array('label'=>'Изменить Категорию', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить Категорию', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>Просмотр Категории #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
                array(
                    'name' => 'parent_id',
                    'value' => ($model->parent_id == 0) ? "-" : $model->findByPk($model->parent_id)->title,
                ),
		'title',
		'url',
		'full_url',
		'content:html',
		'title_menu',
		'meta_title',
		'meta_keywords',
		'meta_desc',
                array(
                    'name' => 'created',
                    'value' => date("j.m.Y G:i:s", $model->created),
                ),
		'sort',
                array(
                    'name' => 'status',
                    'value' => ($model->status == 1) ? "Да" : "Нет",
                ),
	),
)); ?>
