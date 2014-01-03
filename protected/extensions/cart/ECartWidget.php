<?php

class ECartWidget extends CWidget
{
    public function init()
    {
        // этот метод будет вызван внутри CBaseController::beginWidget()
    }
 
    public function run()
    {
        // Открываем сессию.
        $session=new CHttpSession;
        $session->open();
        
        $this->render ('cart', array('model' => $session['cart']));
    }
}