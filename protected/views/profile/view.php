<?php
use yii\helpers\Html;

/**
 * @var yii\base\View $this
 */
$this->title = 'Profile View';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?php echo Html::encode($user->personalInfo->full_name); ?></h1>
    <h1><?php echo Html::encode($user->personalInfo->genderString); ?></h1>
    <h1><?php echo Html::encode($user->personalInfo->date_of_birth); ?></h1>
    <h1><?php echo Html::encode($user->username); ?></h1>
    <h1><?php echo Html::encode($user->personalInfo->full_name); ?></h1>
    <h1><?php echo Html::encode($user->personalInfo->full_name); ?></h1>
    <h1><?php echo Html::encode($user->personalInfo->full_name); ?></h1>
</div>
