<?php
/* @var $this CartController */

$this->breadcrumbs=array(
	'Корзина',
);
?>
<h1><?php echo CHtml::encode($title); ?></h1>

<?php if ($model): ?>
<table class="items">
    <thead>
    <tr>
        <th>#</th>
        <th>Название продукта</th>
        <th>Цена</th>
        <th>Количество</th>
        <th>Сумма</th>
    </tr>
    </thead>
    <tbody>
        <?php $i = 1;
        foreach($model['order'] as $item): ?>
        <tr>
            <td><?= $i; ?></td>
            <td><?= $item['title']; ?></td>
            <td><?= $item['price']; ?></td>
            <td><?= $item['count']; ?></td>
            <td><?= $item['price'] * $item['count']; ?></td>
        </tr>
        <?php $i++;
        endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><?= $model['cart']['count']; ?></td>
            <td><?= $model['cart']['summ']; ?></td>
        </tr>
    </tfoot>
</table>
<?php else: ?>
В корзине нет товаров.
<?php endif; ?>
