<?php

namespace ExceptionCatcher\Parsers;

/**
 * @inheritDoc
 */
final class DefaultParser implements \ExceptionCatcher\ExceptionParser
{
	/**
	 * parse the exception
	 *
	 * @param \Exception $e
	 * @return \ExceptionCatcher\ExceptionEntity
	 */
	public function parse(\Exception $e): \ExceptionCatcher\ExceptionEntity
	{
		return new \ExceptionCatcher\ExceptionEntity($e);
	}
}
