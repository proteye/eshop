<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' | ' . $model->title;
?>

<?php echo CHtml::link('Ссылка на товар',array('site/categ', 'full_url'=>'massazhnyye-kresla/massazhnoye-kreslo-yamaguchi-ya-6000-axiom')); ?>
<br/><br/>
<h1><?= $model->title ?></h1>
<?= $model->content ?>