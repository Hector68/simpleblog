<?php

use app\modules\notification\Module;
use app\modules\simplebolg\SimpleBlog;

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
    ],
];