<?php

namespace ExceptionCatcher;

/**
 * abstraction for exception
 */
class ExceptionEntity
{
	/** @var \Exception */
	protected $exception;

	/**
	 * construct
	 *
	 * @param \Exception $exception
	 */
	public function __construct(\Exception $exception)
	{
		$this->exception = $exception;
	}

	/**
	 * get exception
	 *
	 * @return \Exception
	 */
	public function getException()
	{
		return $this->exception;
	}
}
