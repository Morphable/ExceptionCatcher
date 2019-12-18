<?php

namespace ExceptionCatcher;

/**
 * transport the exception
 */
interface ExceptionTransport
{
	/**
	 * transport the exception
	 *
	 * @param ExceptionEntity $entity
	 * @return void
	 */
	public function send(ExceptionEntity $entity);
}
