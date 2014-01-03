<?php

class CartController extends Controller
{
        protected $title = 'Корзина';
        
        public function filters() {
            return array(
                'ajaxOnly - index',
            );
        }
        
	public function actionAdd($id)
	{
            // Открываем сессию.
            $session=new CHttpSession;
            $session->open();
            // $session->destroy();
            
            // Вытаскиваем значение массива order из сессии в переменную $order.
            $order = $session['order'];
            // Присваиваем цену товара.
            $price = $_GET['price'];
            
            // Проверяем есть ли такой товар в Корзине.
            // Если есть, то увеличиваем количество на 1.
            // Если нет, то добавляем новый элемент в массив с ценой и количеством = 1.
            if (isset($order[$id])) {
                $count = $order[$id]['count'] + 1;
                $order[$id] = array('price' => $price, 'count' => $count);
            }
            else {
                $order[$id] = array('price' => $price, 'count' => 1);
            }
            // Для виджета КОРЗИНА. Вычисляем общее количество товаров.
            $counts = 0; $summ = 0;
            foreach ($order as $ord) {
                $counts += $ord['count'];
                $summ += $ord['price'] * $ord['count'];
            }
            $cart['count'] = $counts; // заносим общее количество товаров.
            $cart['summ'] = $summ; // заносим общую сумму.
            $session['order'] = $order; // выбранные товары.
            $session['cart'] = $cart; // для виджета Корзина.
            
            echo CJSON::encode($cart); // отправляем данные в формате JSON для обновления виджета Корзины.
            Yii::app()->end();
	}

	public function actionDelete()
	{
		// $this->render('index');
	}

	public function actionDeleteAll()
	{
		// $this->render('index');
	}

	public function actionIndex()
	{
            // Открываем сессию.
            $session=new CHttpSession;
            $session->open();
            
            // Вытаскиваем значение массива order из сессии в переменную $order.
            if (!isset($session['order'])) {
                $this->render('index', array(
                    'title' => $this->title,
                ));
            }
            else {
                $order = $session['order'];
                $arr = array();
                foreach($order as $k => $p) {
                    $title = Product::model()->findByPk($k)->title;
                    $arr[] = array('title' => $title, 'price' => $p['price'], 'count' => $p['count']);
                }
                $model['order'] = $arr;
                $model['cart'] = $session['cart'];
                $this->render('index', array(
                    'title' => $this->title,
                    'model' => $model,
                ));
            }
	}
        
        public function getCart()
        {
            // Открываем сессию.
            $session=new CHttpSession;
            $session->open();
            
            if (isset($session['cart']))
                return $session['cart'];
            else
                return false;
        }
        
        // Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}