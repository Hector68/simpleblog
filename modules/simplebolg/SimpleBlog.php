<?php

namespace app\modules\simplebolg;


use app\modules\notification\interfaces\NotificationSubjectInterface;
use app\modules\notification\notifications\EmailUserRegistration;
use app\modules\notification\objects\UserRegistration;
use yii\base\BootstrapInterface;
use yii\base\Module;
use yii\mail\MailerInterface;
use yii2mod\user\events\CreateUserEvent;
use yii2mod\user\models\UserModel;

class SimpleBlog extends Module implements BootstrapInterface
{

    public function bootstrap($app)
    {

        $container = \Yii::$container;

        $container->set(
            UserRegistration::class,
            [],
            [
                [
                    EmailUserRegistration::class
                ]
            ]
        );

        $container->set(
            MailerInterface::class,
            \Yii::$app->mailer
        );



        CreateUserEvent::on(
            UserModel::class,
            UserModel::EVENT_AFTER_INSERT,
            function ($event) use ($container) {
                /**
                 * @var $n NotificationSubjectInterface
                 */
                $n = $container->get(UserRegistration::class, [1 => ['user' => $event->sender]]);
                $n->notifyObservers();
            }
        );


    }

}