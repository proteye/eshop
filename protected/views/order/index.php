<?php
/* @var $this OrderController */

$this->breadcrumbs=array(
	'Заказ',
);
?>
<h1>Заказы</h1>

<?php
foreach($model as $item) {
    $item = explode('::', $item);
    $text = $item[0] . ' - ' . $item[1] . ' руб. - ' . $item[2];
    echo CHtml::link($text, $item[3]) . '<br/>';
}
?>