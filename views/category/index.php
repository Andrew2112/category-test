<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="row">
    <h1 class="text-center">Category Product</h1>
    <?php foreach ($category as $item): ?>
        <?php if ($item->active !== 0): ?>
            <h2 class="text-center"><?= $item->title ?></h2>

            <?php foreach ($item->products as $product): ?>
                <div class="col-md-3">
                    <div class="product text-center">
                        <h3><?= $product->title ?></h3>
                        <div class="product-img ">
                            <?= Html::img(["@web/images/$product->img"]) ?>
                        </div>
                        <p><?= $product->content ?></p>
                        <p>Цена: <?= $product->price ?></p>
                        <?php if ($product->active == 1): ?>
                            <a href="<?= Url::to(['cart/add', 'id' => $product->id]) ?>"
                               type="button" class="btn btn-success add-to-cart"
                               data-id="<?= $product->id ?>">

                                Add to cart
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endforeach; ?>
</div>


