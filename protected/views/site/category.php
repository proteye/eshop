<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' | ' . $model->title;
?>

<h1><?= $model->title ?></h1>
<?= $model->content ?><br/><br/>
<? foreach ($model->products as $item): ?>
<?= CHtml::link($item->title, array('site/categ', 'full_url'=>$item->full_url)) ?>
<br/>
<? endforeach; ?>