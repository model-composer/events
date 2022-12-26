<?php namespace Model\Events;

class Events
{
	private static array $dispatchers;

	private static function getDispatcher(string $dispatcher = ''): Dispatcher
	{
		if (!isset(self::$dispatchers[$dispatcher]))
			self::$dispatchers[$dispatcher] = new Dispatcher();
		return self::$dispatchers[$dispatcher];
	}

	public static function dispatch(object $event, string $dispatcher = ''): object
	{
		return self::getDispatcher($dispatcher)->dispatch($event);
	}

	public static function subscribeTo(string $event, callable $listener, string $dispatcher = ''): void
	{
		self::getDispatcher($dispatcher)->subscribeTo($event, $listener);
	}
}
