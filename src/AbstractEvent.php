<?php namespace Model\Events;

abstract class AbstractEvent
{
	abstract public function getData(): array;
}
