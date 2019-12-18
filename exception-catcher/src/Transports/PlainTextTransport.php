<?php

namespace ExceptionCatcher\Transports;

/**
 * @inheritDoc
 */
final class PlainTextTransport implements \ExceptionCatcher\ExceptionTransport
{
	/** @var string */
	protected $path;

	/**
	 * construct
	 *
	 * @param string $path
	 */
	public function __construct(string $path)
	{
		$this->path = $path;
	}

	/**
	 * transport the exception
	 *
	 * @param \ExceptionCatcher\ExceptionEntity $entity
	 * @return void
	 */
	public function send(\ExceptionCatcher\ExceptionEntity $entity)
	{
		file_put_contents($this->path, ((string) $entity->getException()) . "\n\n", FILE_APPEND);
	}
}
