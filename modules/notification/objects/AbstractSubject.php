<?php
/**
 * Date: 18.02.2017
 * Time: 21:57
 */

namespace app\modules\notification\objects;


use app\modules\notification\interfaces\NotificationObserverInterface;
use app\modules\notification\interfaces\NotificationSubjectInterface;

/**
 * Class AbstractSubject
 * @package app\modules\notification\objects
 */
abstract class AbstractSubject implements NotificationSubjectInterface
{

    /**
     * @var array
     */
    private $data = [];

    /**
     * @var NotificationObserverInterface[]
     */
    private $observers = [];


    /**
     * AbstractSubject constructor.
     * @param array $observersClasses
     * @param array $data
     */
    public function __construct(array $observersClasses, array $data)
    {
        $this->data = $data;

        foreach ($observersClasses as $class) {
            $this->registerObserver(\Yii::createObject($class, [$this]));
        }

    }

    /**
     * @param NotificationObserverInterface $observer
     * @return bool
     */
    public function registerObserver(NotificationObserverInterface $observer)
    {
        if ($observer instanceof NotificationObserverInterface) {
            $this->observers[] = $observer;
            return true;
        }
        return false;

    }

    /**
     * @param NotificationObserverInterface $observer
     * @return bool
     */
    public function removeObserver(NotificationObserverInterface $observer)
    {
        if (($key = array_search($observer, $this->observers)) !== false) {
            unset($this->observers[$key]);
            return true;
        }

        return false;
    }

    /**
     * @return array
     */
    public function getAllObservers()
    {
        return $this->observers;
    }

    /**
     *
     */
    public function notifyObservers()
    {
        foreach ($this->observers as $observer) {
            $observer->notify();
        }
    }
    
    
    public function getSubjectData()
    {
        return $this->data;
    }

}