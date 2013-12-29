<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs=array(
	'Товары'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Список Товаров', 'url'=>array('index')),
	array('label'=>'Добавить Товар', 'url'=>array('create')),
	array('label'=>'Изменить Товар', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить Товар', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>Просмотр Товара #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
                array(
                    'name' => 'category_id',
                    'value' => Category::model()->findByPk($model->category_id)->title,
                ),
		'title',
		'url',
		'full_url',
		'article',
		'price',
		'count',
                array(
                    'name' => 'images',
                    'type'=>'html',
                    'value' => function($model) {
                        $images = Image::model()->findAllByAttributes(array('product_id' => $model->id));
                        foreach ($images as $img) {
                            ($img->id == $model->image_id) ? $style = ' border: 5px dashed #00FF00;' : $style = '';
                            $image .= CHtml::image($img->getImageUrl(), $data->title, array('style' => 'height: 100px;' . $style));
                        }
                        return $image;
                    }
                ),
		'description:html',
                array(
                    'name' => 'created',
                    'value' => date("j.m.Y G:i:s", $model->created),
                ),
		'meta_title',
		'meta_keywords',
		'meta_desc',
		'old_price',
		'recommended',
		'novelty',
                array(
                    'name' => 'status',
                    'value' => ($model->status == 1) ? "Да" : "Нет",
                ),
	),
)); ?>
