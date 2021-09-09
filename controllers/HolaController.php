<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\base\Controller;
#http://localhost:8080/hola/index

class HolaController extends Controller{

    public function actionIndex()
    {
        $t = "@faove";
        // $model = ActiveRecord::model("Users")->findAll();
        return $this->render("index",array("t" => $t));
    }
}