<?php
/**
 * Date: 18.02.2017
 * Time: 21:20
 */

namespace app\modules\simplebolg\controllers;


use yii\web\Controller;

class SiteController extends Controller
{
    
    public function actionIndex()
    {
        return $this->render('index');
    }
}