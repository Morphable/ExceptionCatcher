<?php

namespace ExceptionCatcher;

/**
 * client thats handles the library
 */
final class ExceptionClient
{
	/** @var ExceptionTransport */
	protected $transport;

	/** @var ExceptionParser */
	protected $parser;

	/** @var ExceptionEntity[] */
	protected $exceptions = [];

	/**
	 * construct
	 *
	 * @param ExceptionParser $parser
	 * @param ExceptionTransport $transport
	 */
	public function __construct(ExceptionParser $parser, ExceptionTransport $transport)
	{
		$this->transport = $transport;
		$this->parser = $parser;
	}

	/**
	 * logs uncaught errors
	 *
	 * @return self
	 */
	public function setUncaughtHandler()
	{
		set_exception_handler(function ($e) {
			$this->add($e);
			$this->handle();
			
			if (error_reporting() > 0) {
				throw $e;
			}
		});

		return $this;
	}

	/**
	 * add exception to queue
	 *
	 * @param \Exception $exception
	 * @return self
	 */
	public function add(\Exception $exception)
	{
		// turn errors into exceptions
		if (!$exception instanceof \Exception && method_exists($exception, '__toString')) {
			$exception = new \Exception((string) $exception);
		}

		if (!$this->isDuplicate($exception)) {
			$this->exceptions[] = $this->parser->parse($exception);
		}

		return $this;
	}

	/**
	 * handle queue
	 *
	 * @return void
	 */
	public function handle()
	{
		(new ExceptionHandler($this->exceptions, $this->transport))->handle();
		$this->resetQueue();
	}

	/**
	 * check exception is duplicate
	 *
	 * @param \Exception $exception
	 * @return bool
	 */
	protected function isDuplicate(\Exception $exception)
	{
		foreach ($this->exceptions as $e) {
			if ($e->getException->getMessage() === $exception->getMessage()) {
				return true;
			}
		}

		return false;
	}

	/**
	 * reset the queue
	 *
	 * @return self
	 */
	protected function resetQueue()
	{
		$this->exceptions = [];

		return $this;
	}
}
