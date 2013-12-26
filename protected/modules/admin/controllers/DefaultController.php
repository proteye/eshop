<?php

class DefaultController extends Controller
{
        public function beforeAction($action) {
            if (!Yii::app()->user->checkAccess('admin'))
                throw new CHttpException(404,'Указанная страница не найдена');
            
            return parent::beforeAction($action);
        }

	public function actionIndex()
	{
		$this->render('index');
	}
}