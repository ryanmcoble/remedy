<?php
namespace Coble\General\Commanding;

use Exception;


class CommandTranslator
{

	public function toCommandHandler($command)
	{
		$handler = preg_replace('/Command$/', 'CommandHandler', get_class($command)); // last occurence only

		if(!class_exists($handler))
		{
			$message = "Command handler [$handler] does not exist.";

			throw new Exception($message);
		}

		return $handler;
	}

}