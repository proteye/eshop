<?php

class OrderController extends Controller
{
        /**
         * Оформление нового заказа.
         */
	public function actionAdd()
	{
            $model = new Order;
            
            if(isset($_POST['Order']))
            {
                $model->attributes = $_POST['Order'];
                
                if($model->save()) {
                    $model->cart_clear();
                    $this->redirect(array('index', 'id' => $model->id));
                }
            }
            
            $this->render('add', array(
                'model' => $model,
            ));
	}

	public function actionIndex($id = 1)
	{
            $model = Order::model()->findByPk($id);
            $content = explode(';;', $model->order_content);
            
            $this->render('index', array(
                'model' => $content,
            ));
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