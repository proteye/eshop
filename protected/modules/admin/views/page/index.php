<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	'Страницы'=>array('index'),
	'Список',
);

$this->menu=array(
	array('label'=>'Добавить страницу', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#page-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Список Страниц</h1>

<p>
Вы можете использовать операторы (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) в начале вашего поискового запроса.
</p>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'page-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
                array(
                    'name' => 'parent_id',
                    'value' => '($data->parent_id == 0) ? "-" : $data->findByPk($data->parent_id)->title',
                ),
		'title',
		'url',
                array(
                    'name' => 'created',
                    'value' => 'date("j.m.Y", $data->created)',
                ),
                /*
		'full_url',
		'content',
		'title_menu',
		'meta_title',
		'meta_keywords',
		'meta_desc',
		'sort',
                */
                array(
                    'name' => 'status',
                    'value' => '($data->status == 1) ? "Да" : "Нет"',
                ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
