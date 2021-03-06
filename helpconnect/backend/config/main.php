<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'giver' => 'backend\modules\giver\Giver',
        'seeker' => 'backend\modules\seeker\Seeker',
        'item' => 'backend\modules\item\Item',
        'offer' => 'backend\modules\offer\Offer',
        'request' => 'backend\modules\request\Request',
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend-help',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend-help', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend-help',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],

        'assetManager' => [
            'appendTimestamp' => true,
        ],
    ],
    'as AccessBehavior' => [
        'class' => 'backend\components\AccessBehavior',
    ],
    'params' => $params,
];
