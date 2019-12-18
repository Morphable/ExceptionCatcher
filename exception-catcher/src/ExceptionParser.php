<?php

namespace ExceptionCatcher;

/**
 * parse the exception
 */
interface ExceptionParser
{
	/**
	 * parse the exception
	 *
	 * @param \Exception $e
	 * @return ExceptionEntity
	 */
	public function parse(\Exception $e): ExceptionEntity;
}
