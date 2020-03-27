<?php

/*
 * In configuration file
 * ...
 * 'as AccessBehavior' => [
 *    'class' => '\app\components\AccessBehavior'
 * ]
 * ...
 * (c) Artem Voitko <r3verser@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace backend\components;

use yii;
use yii\base\Behavior;
use yii\console\Controller;

/**
 * Redirects all users to login page if not logged in
 *
 * Class AccessBehavior
 * @package app\components
 * @author  Artem Voitko <r3verser@gmail.com>
 */
class AccessBehavior extends Behavior
{
    /**
     * Subscribe for events
     * @return array
     */
    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'beforeAction'
        ];
    }

    /**
     * On event callback
     */
    public function beforeAction()
    {
        if (!Yii::$app->request->isConsoleRequest && Yii::$app->controller->uniqueId != 'site' && !(Yii::$app->user->can('adminBackend') || (Yii::$app->controller->module && Yii::$app->user->can(Yii::$app->controller->module->id)))) {
            throw new yii\web\ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
        }
    }
}