<?php

namespace app\commands;
use yii\console\Controller;
use yii\console\ExitCode;
use yii;
use app\models\Libros;
use app\models\LibroSearch;
use Codeception\Command\Console;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class Extra extends Controller{
    
    public function e(&#036;var){
    
        header('Content-type: text/plain; charset=utf-8');
        
        print_r(&#036;var);
        
        exit;
        
    }
    
    
}


?>