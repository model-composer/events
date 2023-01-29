<?php namespace Model\Events;

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\ListenerProviderInterface;

class Dispatcher implements EventDispatcherInterface, ListenerProviderInterface
{
	private array $listeners = [];

	public function dispatch(object $event): AbstractEvent
	{
		if (!is_subclass_of($event, AbstractEvent::class))
			throw new \Exception('Bad event type');

		$listeners = $this->getListenersForEvent($event);
		foreach ($listeners as $listener)
			call_user_func($listener, $event);

		return $event;
	}

	public function subscribeTo(?string $event, callable $listener): void
	{
		if ($event === null)
			$event = '*';

		if (!isset($this->listeners[$event]))
			$this->listeners[$event] = [];
		$this->listeners[$event][] = $listener;
	}

	public function getListenersForEvent(object $event): iterable
	{
		if (!is_subclass_of($event, AbstractEvent::class))
			throw new \Exception('Bad event type');

		$listeners = $this->listeners[get_class($event)] ?? [];
		if (isset($this->listeners['*']))
			$listeners = array_merge($listeners, $this->listeners['*']);
		return $listeners;
	}
}
