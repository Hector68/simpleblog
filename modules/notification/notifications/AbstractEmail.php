<?php
/**
 * Date: 18.02.2017
 * Time: 22:46
 */

namespace app\modules\notification\notifications;


use app\modules\notification\interfaces\NotificationSubjectInterface;
use yii\helpers\ArrayHelper;
use yii\mail\MailerInterface;

abstract class AbstractEmail extends AbstractNotification
{

    protected $key;
    protected $mails = [];
    protected $mailer;

    public function __construct(NotificationSubjectInterface $subject, MailerInterface $mailer)
    {
        $this->mailer = $mailer;
        parent::__construct($subject);
    }


    protected function getKey()
     {
         return $this->key;
     }

    protected function getEmailData()
    {
        return [
            'subject' => '',
            'tpl' => ''
        ];
    }

    /**
     * @return mixed
     */
    public function getSubjectText()
    {
        $tpl = $this->getEmailData()['subject'];
        return strtr($tpl, $this->getReplaceData());
    }

    protected function getMailText()
    {
        $tpl = $this->getEmailData()['tpl'];
        return strtr($tpl, $this->getReplaceData());
        
    }



    protected function sendMail()
    {

      $result =  $this->mailer->compose()
            ->setFrom(\Yii::$app->params['senderEmail'])
            ->setTo($this->mails)
            ->setSubject($this->getSubjectText())
            ->setHtmlBody($this->getMailText())
            ->send();

        return $result;

    }



    abstract protected function getReplaceData();


    public function notify()
    {
        return $this->sendMail();
    }
    
}