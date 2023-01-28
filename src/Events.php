<?php namespace Model\Events;

class Events
{
	private static array $dispatchers = [];

	private static function getDispatcher(string $dispatcher = ''): Dispatcher
	{
		if (!isset(self::$dispatchers[$dispatcher]))
			self::$dispatchers[$dispatcher] = new Dispatcher();
		return self::$dispatchers[$dispatcher];
	}

	public static function dispatch(AbstractEvent $event, string $dispatcher = ''): AbstractEvent
	{
		return self::getDispatcher($dispatcher)->dispatch($event);
	}

	public static function subscribeTo(string $event, callable $listener, string $dispatcher = ''): void
	{
		self::getDispatcher($dispatcher)->subscribeTo($event, $listener);
	}
}
