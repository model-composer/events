<?php namespace Model\Events;

abstract class AbstractEvent
{
	final public function getEventName(): string
	{
		$eventName = explode('\\', get_class($this));
		return end($eventName);
	}

	abstract public function getData(): array;
}
