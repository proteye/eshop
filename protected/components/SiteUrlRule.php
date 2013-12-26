<?php

class SiteUrlRule extends CBaseUrlRule
{
    public $connectionID = 'db';

    public function createUrl($manager,$route,$params,$ampersand)
    {
        if ($route==='site/categ')
        {
            if (isset($params['full_url']))
                return $params['full_url'];
        }
        return false;  // не применяем данное правило
    }

    public function parseUrl($manager,$request,$pathInfo,$rawPathInfo)
    {
        // Расскомментируйте, если хотите использовать gii-генератор, а он не работает.
        /*
        if (strpos($pathInfo, 'gii') !== FALSE ) {
            return false;
        }
        */
        
        // Это продукт?
        if ($url = Product::model()->findByAttributes(array('full_url' => $pathInfo)))
        {
            $_GET['catg'] = 'product';
            $_GET['id'] = $url->getPrimaryKey();
            return 'site/categ';
        }
        // Или это категория товаров?
        elseif ($url = Category::model()->findByAttributes(array('full_url' => $pathInfo)))
        {
            $_GET['catg'] = 'category';
            $_GET['id'] = $url->getPrimaryKey();
            return 'site/categ';
        }
        // Или это статичная страница?
        elseif ($url = Page::model()->findByAttributes(array('full_url' => $pathInfo)))
        {
            $_GET['catg'] = 'page';
            $_GET['id'] = $url->getPrimaryKey();
            return 'site/categ';
        }
        
        return false;  // не применяем данное правило
    }
}