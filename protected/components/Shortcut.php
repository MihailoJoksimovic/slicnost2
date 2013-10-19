<?php

/**
 *  This file contains global functions that acts as shortcuts to commonly used methods
 */

/**
 * Shortcut to CHtml::encode()
 *
 * @param string $string String to encode
 * @return string Encoded string
 */
function e($string)
{
    return htmlspecialchars($string, ENT_QUOTES, Yii::app()->charset);
}

/**
 * Shortcut to Yii::app()
 *
 * @return CApplication application instance
 */
function a()
{
    return Yii::app();
}

/**
 * Shortcut to Yii::app()->db
 *
 * @return CDbConnection database connection
 */
function db()
{
    return Yii::app()->getDb();
}

/**
 * Shortcut to Yii::app()->user
 *
 * @return WebUser user instance
 */
function u()
{
    return Yii::app()->getUser();
}

/**
 * Shortcut to Yii::app()->user->id
 *
 * @return User id
 */
function uid()
{
    return Yii::app()->user->id;
}

/**
 * Shortcut to Yii::t()
 * Note: $category parameter is on third place!
 *
 * @param string $message Message for translation
 * @param array $params Data for message
 * @param string $category Category
 * @param string $source Source
 * @param string $language Language
 * @return string Translated message
 */
function t($message, $params = array(), $category = 'imp', $source = null, $language = null)
{
    return Yii::t($category, $message, $params, $source, $language);
}

/**
 * Shortcut to Yii::app()->controller->createUrl() OR Yii::app()->controller->createAbsoluteUrl()
 * Pass true as third parameter to create absolute url
 *
 * @param string $route route
 * @param array $params route params
 * @param boolean $absolute Whether to generate absolute url. Defaults to false meaning relative
 * @param string $ampersand ampersand
 * @param string $schema schema
 * @return string generated url
 */
function url($route, $params = array(), $absolute = false, $addSlash = false, $ampersand = '&', $schema = '')
{
    if (!is_object(Yii::app()->getController())) {
        return;
    }
    if ($addSlash && substr($route, 0, 1) != '/') {
        $route = '/' . $route;
    }
    $url = '';
    if ($absolute) {
        $url = Yii::app()->getController()->createAbsoluteUrl($route, $params, $schema, $ampersand);
    } else {
        $url = Yii::app()->getController()->createUrl($route, $params, $ampersand);
    }
    return $url;
}

/**
 * Shortcut to Yii::app()->request->isAjaxRequest
 *
 * @return boolean true if is ajax request, false otherwise
 */
function isAjax()
{
    return Yii::app()->getRequest()->getIsAjaxRequest();
}

/**
 * Shortcut to Yii::app()->db->createCommand()
 *
 * @param mixed $query Query
 * @return CDbCommand instance
 */
function sql($query = null)
{
    return Yii::app()->getDb()->createCommand($query);
}

/**
 * Shortcut to Yii::app()->user->isGuest
 *
 * @return boolean true if user is guest, false otherwise
 */
function isGuest()
{
    return Yii::app()->getUser()->getIsGuest();
}

/**
 * Shortcut for Yii::app()->request->csrfToken
 *
 * @return string hash for CSRF protection
 */
function csrfToken()
{
    return Yii::app()->getRequest()->getCsrfToken();
}

/**
 * Shortcut to Yii::app()->request->csrfTokenName
 *
 * @return string name of the csrf token. Defaults to CSRF_TOKEN
 */
function csrfTokenName()
{
    return Yii::app()->getRequest()->csrfTokenName;
}

function p($v)
{
    die('<pre>' . print_r($v, true) . '</pre>');
}

function v($v)
{
    die(var_dump($v));
}

function d($v = '')
{
    die((string) $v);
}
