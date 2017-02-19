<?php

namespace app\modules\notification\notifications;


use app\modules\notification\interfaces\NotificationSubjectInterface;
use yii\helpers\ArrayHelper;
use yii\mail\MailerInterface;

class EmailUserRegistration extends AbstractEmail
{
    public function __construct(NotificationSubjectInterface $subject, MailerInterface $mailer)
    {
        $this->key = 'user.registration';
        $this->mails = ArrayHelper::getValue($subject->getSubjectData(), 'user.email', []) ;
        parent::__construct($subject, $mailer);
    }

    protected function getEmailData()
    {
        return [
            'subject' => 'Вы успешно зарегистрировались',
            'tpl' => 'Здравствуйте, {username}. Спасибо за регистрацию!'
        ];
    }

    protected function getReplaceData()
    {
        $subjectData = $this->subject->getSubjectData();

        return [
            '{username}' => ArrayHelper::getValue($subjectData['user'], 'username')
        ];
    }
}