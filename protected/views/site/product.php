<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' | ' . $model->title;
?>
<?php echo CHtml::link('Доставка',array('site/categ', 'full_url'=>'dostavka')); ?>
<br/><br/>
<h1><?= $model->title ?></h1>
<?= $model->description ?>
<?= CHtml::image(Yii::app()->getBaseUrl(true) . $model::UPLOAD_FOLDER . $model->main_image->name,'',array('width'=>'40%')); ?>
<? foreach ($model->other_images as $img):
    if ($model->image_id != $img->id): ?>
    <?= CHtml::image(Yii::app()->getBaseUrl(true) . $model::UPLOAD_FOLDER . $img->name,'',array('width'=>'40%')); ?>
<?  endif;
endforeach; ?>
