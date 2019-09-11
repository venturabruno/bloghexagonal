<?php

declare(strict_types=1);

namespace App\Core\Domain;

abstract class Entity
{
    protected $id;
    protected $listNotification = [];

    public function id(): UuId
    {
        return $this->id;
    }

    protected function setId(UuId $id)
    {
        $this->id = $id;
    }

    public function addDomainEvent(Notification $eventItem)
    {
        $this->listNotification[] = $eventItem;
    }

    public function removeDomainEvent(Notification $eventItem)
    {
        $key = in_array($eventItem, $this->listNotification);
        unset($this->listNotification[$key]);
    }

    public function equals(Entity $object): bool
    {
        if ($this === $object) {
            return true;
        }

        if ($this->id() === $object->id()) {
            return true;
        }

        return false;
    }
}
