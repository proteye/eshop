<div id="cart-widget">
<?php
if ($model) {
    echo 'Количество: ' . $model['count'] . '<br/>';
    echo 'Сумма: ' . $model['summ'];
}
else
    echo 'В корзине нет товаров.';
?>
</div>