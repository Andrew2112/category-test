<?php

namespace app\controllers;

use app\models\Category;
use yii\web\Controller;


class CategoryController extends Controller
{
    public function actionIndex()
    {
        $category=Category::find()->with('products')->all();

        return $this->render('index', compact('category'));
    }

}
