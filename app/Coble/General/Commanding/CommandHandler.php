<?php
namespace Coble\General\Commanding;


interface CommandHandler
{
	/**
	 * Handle the command
	 *
	 * @param $command - data transfer object for a command
	 */
	public function handle($command);
}