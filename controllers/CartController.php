<?php


namespace app\controllers;


use app\models\Cart;
use app\models\Order;
use app\models\OrderProduct;
use app\models\Product;
use Yii;
use yii\web\Controller;

class CartController extends Controller
{
    public function actionAdd($id)
    {

        $product = Product::findOne($id);
        if (empty($product)) {
            return false;
        }
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product);

        if (Yii::$app->request->isAjax) {
            return $this->renderPartial('cart-modal', compact('session'));
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionShow()
    {
        $session = Yii::$app->session;
        $session->open();
        return $this->renderPartial('cart-modal', compact('session'));
    }

    public function actionDelItem($id)
    {
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->recalc($id);
        return $this->renderPartial('cart-modal', compact('session'));
    }

    public function actionClearCart()
    {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');
        return $this->renderPartial('cart-modal', compact('session'));
    }

    public function actionCheckout()
    {
        $session = Yii::$app->session;
        $order = new Order();
        $order_product = new OrderProduct();

            $order->session=session_id();
            $order->qty = $session['cart.qty'];
            $order->total = $session['cart.sum'];
            $transaction=Yii::$app->getDb()->beginTransaction();
            if(!$order->save() || !$order_product->saveOrderProducts($session['cart'],$order->id)){
               // Yii::$app->session->setFlash('error', 'Ошибка сохранения заказа');
                $transaction->rollBack();
            }else{
                $transaction->commit();
                Yii::$app->session->setFlash('success', 'Заказ сохранен');
                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');
                return $this->refresh();
            }
        $session->destroy();
        return $this->redirect(Yii::$app->request->referrer);
    }


}