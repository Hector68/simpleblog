<?php
/**
 * Date: 18.02.2017
 * Time: 12:01
 */

namespace app\modules\notification\interfaces;


/**
 * Interface NotificationObserverInterface
 * @package app\modules\notification\interfaces
 */
interface NotificationObserverInterface
{

    
    /**
     * @return NotificationSubjectInterface
     */
    public function getSubject();

    /**
     * @return bool
     */
    public function notify();
    
}