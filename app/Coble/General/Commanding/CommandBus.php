<?php
namespace Coble\General\Commanding;


interface CommandBus
{
	public function execute($command);
}