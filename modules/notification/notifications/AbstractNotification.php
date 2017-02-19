<?php
/**
 * Date: 18.02.2017
 * Time: 22:47
 */

namespace app\modules\notification\notifications;


use app\modules\notification\interfaces\NotificationObserverInterface;
use app\modules\notification\interfaces\NotificationSubjectInterface;

/**
 * Class AbstractNotification
 * @package app\modules\notification\notifications
 */
abstract class AbstractNotification implements NotificationObserverInterface
{

    /**
     * @var NotificationSubjectInterface
     */
    protected $subject;

    /**
     * AbstractNotification constructor.
     * @param NotificationSubjectInterface $subject
     */
    public function __construct(NotificationSubjectInterface $subject)
    {
       $this->subject = $subject;
    }

    /**
     * @return NotificationSubjectInterface
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return mixed
     */
    abstract public function notify();

}