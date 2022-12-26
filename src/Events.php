<?php namespace Model\Events;

use League\Event\EventDispatcher;
use League\Event\ListenerPriority;

class Events
{
	private static EventDispatcher $dispatcher;

	private static function getDispatcher(): EventDispatcher
	{
		if (!isset(self::$dispatcher))
			self::$dispatcher = new EventDispatcher();
		return self::$dispatcher;
	}

	public static function dispatch(object $event): object
	{
		return self::getDispatcher()->dispatch($event);
	}

	public static function subscribeTo(string $event, callable $listener, int $priority = ListenerPriority::NORMAL): void
	{
		self::getDispatcher()->subscribeTo($event, $listener, $priority);
	}
}
