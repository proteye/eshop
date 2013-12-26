<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' | ' . $model->title;
?>
<?php echo CHtml::link('Доставка',array('site/categ', 'full_url'=>'dostavka')); ?>
<br/><br/>
<h1><?= $model->title ?></h1>
<?= $model->description ?>