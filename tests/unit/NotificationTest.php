<?php
namespace tests;

use app\modules\notification\interfaces\NotificationObserverInterface;
use app\modules\notification\interfaces\NotificationSubjectInterface;
use app\modules\notification\notifications\EmailUserRegistration;
use app\modules\notification\objects\UserRegistration;
use yii\mail\MailerInterface;
use yii\mail\MessageInterface;

class NotificationTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    public $tester;

    protected function _before()
    {
        $container = \Yii::$container;

        $container->set(
            MailerInterface::class,
            \Yii::$app->mailer
        );

        $container->set(
            UserRegistration::class,
            [],
            [
                [
                    EmailUserRegistration::class
                ]
            ]
        );
    }
    

    // tests
    public function testContainer()
    {

        $container = \Yii::$container;
        /***
         * @var NotificationSubjectInterface $n
         */
        $n = $container->get(UserRegistration::class, [1 => ['user' => '']]);

        $this->assertInstanceOf(NotificationSubjectInterface::class, $n);
    }


    public function testObserversAdd()
    {
        $container = \Yii::$container;
        /***
         * @var NotificationSubjectInterface $n
         */
        $n = $container->get(
            UserRegistration::class,
            [
                1 => [
                    'user' => [
                        'username' => 'Test name',
                        'email' =>'test-user@email.com'
                    ]
                ]
            ]
        );
        $this->assertCount(1, $n->getAllObservers());

        $n->notifyObservers();

        // using Yii2 module actions to check email was sent
        $this->tester->seeEmailIsSent();

        /**
         * @var MessageInterface $emailMessage
         */
        $emailMessage = $this->tester->grabLastSentEmail();


        $this->assertInstanceOf(MessageInterface::class, $emailMessage);

        $this->assertArrayHasKey('test-user@email.com', $emailMessage->getTo());

    }


    public function testMail()
    {
        /**
         * @var NotificationObserverInterface $emailNotification
         */
        $emailNotification = \Yii::createObject(
            EmailUserRegistration::class,
            [
                new UserRegistration(
                    [],
                    [
                        'user' => [
                            'username' => 'Test',
                            'email' => 'user@test.ru'
                        ]
                    ])
            ]
        );

        $this->assertInstanceOf(NotificationObserverInterface::class, $emailNotification);
        $this->assertTrue($emailNotification->notify());


        
    }
}
