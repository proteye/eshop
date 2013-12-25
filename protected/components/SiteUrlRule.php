<?php

class SiteUrlRule extends CBaseUrlRule
{
    public $connectionID = 'db';

    public function createUrl($manager,$route,$params,$ampersand)
    {
        if ($route==='site/category')
        {
            if (isset($params['manufacturer'], $params['model']))
                return $params['manufacturer'] . '/' . $params['model'];
            else if (isset($params['manufacturer']))
                return $params['manufacturer'];
        }
        return false;  // не применяем данное правило
    }

    public function parseUrl($manager,$request,$pathInfo,$rawPathInfo)
    {
        // Это продукт?
        if ($url = Product::model()->findByAttributes(array('full_url' => $pathInfo)))
        {
            $_GET['catg'] = 'product';
            $_GET['id'] = $url->getPrimaryKey();
            return 'site/category';
        }
        // Или это категория товаров?
        elseif ($url = Category::model()->findByAttributes(array('full_url' => $pathInfo)))
        {
            $_GET['catg'] = 'category';
            $_GET['id'] = $url->getPrimaryKey();
            return 'site/category';
        }
        // Или это статичная страница?
        elseif ($url = Page::model()->findByAttributes(array('full_url' => $pathInfo)))
        {
            $_GET['catg'] = 'page';
            $_GET['id'] = $url->getPrimaryKey();
            return 'site/category';
        }
        return false;  // не применяем данное правило
    }
}