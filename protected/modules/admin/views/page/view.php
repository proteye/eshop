<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	'Страницы'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Список страниц', 'url'=>array('index')),
	array('label'=>'Добавить страницу', 'url'=>array('create')),
	array('label'=>'Изменить страницу', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить страницу', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены, что хотите удалить данный элемент?')),
);
?>

<h1>View Page #<?php echo $model->id; ?></h1>

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
		'title_menu',
		'content:html',
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
