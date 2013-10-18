<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \app\models\PersonalInfo;
use yii\helpers\BaseHtml;

/**
 * @var yii\base\View $this
 * @var yii\widgets\ActiveForm $form
 * @var common\models\User $user
 */
$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?php echo Html::encode($this->title); ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(array('id' => 'form-signup')); ?>
                <?php echo $form->field($user, 'email'); ?>
                <?php echo $form->field($personalInfo, 'first_name'); ?>
                <?php echo $form->field($personalInfo, 'last_name'); ?>
                <?php echo BaseHtml::activeDropDownList($personalInfo, 'gender', array(
                    PersonalInfo::GENDER_MALE => 'Male',
                    PersonalInfo::GENDER_FEMALE => 'Female'
                )); ?>
                <?php echo $form->field($user, 'password')->passwordInput(); ?>
                <div class="form-group">
                    <?php echo Html::submitButton('Signup', array('class' => 'btn btn-primary')); ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
