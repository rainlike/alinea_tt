<?php

use app\forms\LoginForm;
use app\widgets\Alert;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\web\View;

/* @var $this View */
/* @var $form ActiveForm */
/* @var $model LoginForm */
?>

<div class="row mt-5">
    <div class="col-lg-4 col-md-8 col-12 mx-auto">
        <div class="card">
            <div class="card-header">
                Sign In
            </div>
            <div class="card-body">
                <?= Alert::widget() ?>
                <?php $form = ActiveForm::begin([
                    'id' => 'login-form'
                ]); ?>

                <?= $form
                    ->field($model, 'email')
                    ->label($model->getAttributeLabel('email'))
                    ->textInput()
                ?>

                <?= $form
                    ->field($model, 'password')
                    ->label($model->getAttributeLabel('password'))
                    ->passwordInput()
                ?>

                <?= $form
                    ->field($model, 'rememberMe')
                    ->label($model->getAttributeLabel('rememberMe'))
                    ->checkbox()
                ?>

                <div class="text-center">
                    <?= Html::submitButton('Sign in', ['class' => 'btn btn-primary'])?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
