<?php

namespace app\modules\notification\interfaces;


/**
 * Interface NotificationSubjectInterface
 * @package app\modules\notification\interfaces
 */
/**
 * Interface NotificationSubjectInterface
 * @package app\modules\notification\interfaces
 */
interface NotificationSubjectInterface
{
    
    /**
     * @param NotificationObserverInterface $observer
     * @return bool
     */
    public function registerObserver(NotificationObserverInterface $observer);

    /**
     * @param NotificationObserverInterface $observer
     * @return bool
     */
    public function removeObserver(NotificationObserverInterface $observer);

    /**
     * @return NotificationObserverInterface[]
     */
    public function getAllObservers();

    /**
     * @return void
     */
    public function notifyObservers();


    /**
     * @return array
     */
    public function getSubjectData();
}