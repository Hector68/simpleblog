<?php


use app\modules\simplebolg\SimpleBlog;
use yii2mod\user\models\UserModel;

return [
    'bootstrap' => ['simpleblog'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'simpleblog' => [
            'class' => SimpleBlog::class
        ],
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'modules' => [
                'rbac' => [
                    'class' => 'yii2mod\rbac\Module',
                    // Some controller property maybe need to change.
                    'controllerMap' => [
                        'assignment' => [
                            'class' => 'yii2mod\rbac\controllers\AssignmentController',
                            'userIdentityClass' => UserModel::class,
                            'searchClass' => [
                                'class' => 'yii2mod\rbac\models\search\AssignmentSearch',
                                'pageSize' => 10,
                            ],
                            'idField' => 'id',
                            'usernameField' => 'username',
                            'gridViewColumns' => [
                                'id',
                                'username',
                                'email'
                            ]
                        ],
                        'role' => [
                            'class' => 'yii2mod\rbac\controllers\RoleController',
                            'searchClass' => [
                                'class' => 'yii2mod\rbac\models\search\AuthItemSearch',
                                'pageSize' => 10,
                            ],
                        ],
                        'rule' => [
                            'class' => 'yii2mod\rbac\controllers\RuleController',
                            'searchClass' => [
                                'class' => 'yii2mod\rbac\models\search\BizRuleSearch',
                                'pageSize' => 10
                            ],
                        ],
                        'route' => [
                            'class' => 'yii2mod\rbac\controllers\RouteController',
                            // for example: exclude `api, debug and gii` modules from list of routes
                            'modelClass' => [
                                'class' => 'yii2mod\rbac\models\RouteModel',
                                'excludeModules' => ['api', 'debug', 'gii'],
                            ],
                        ],
                    ]
                ],
            ]
        ],
    ],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest', 'user']
        ],
    ]
];