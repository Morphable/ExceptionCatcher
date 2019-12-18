<?php

namespace ExceptionCatcher;

/**
 * handle the queue
 */
class ExceptionHandler
{
	/** @var ExceptionTransport */
	protected $transport;

	/** @var ExceptionEntity[] */
	protected $queue;

	/**
	 * construct
	 *
	 * @param array $queue
	 * @param ExceptionTransport $transport
	 */
	public function __construct(array $queue, ExceptionTransport $transport)
	{
		$this->queue = $queue;
		$this->transport = $transport;
	}

	/**
	 * handle the queue
	 *
	 * @return void
	 */
	public function handle()
	{
		if (empty($this->queue)) {
			return;
		}

		// execute transporter
		$this->transport->send(reset($this->queue));

		// remove from queue
		array_shift($this->queue);

		// handle again
		$this->handle();
	}
}
