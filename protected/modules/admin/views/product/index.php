<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs=array(
	'Товары'=>array('index'),
	'Список',
);

$this->menu=array(
	array('label'=>'Добавить товар', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#product-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Список Товаров</h1>

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
	'id'=>'product-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
                array(
                    'name' => 'category_id',
                    'value' => 'Category::model()->findByPk($data->category_id)->title',
                ),
		'title',
                /*
		'url',
		'full_url',
		'description',
                */
		'article',
		'price',
		// 'image_id',
		'count',
                /*
		'meta_title',
		'meta_keywords',
		'meta_desc',
		'old_price',
		'recommended',
		'novelty',
                */
		'status',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
