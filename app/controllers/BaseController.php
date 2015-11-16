<?php

use Coble\General\Commanding\CommandBus;


class BaseController extends Controller {

	protected $commandBus;
	

	public function __construct(CommandBus $commandBus)
	{

		// inject the command bus
		$this->commandBus  = $commandBus;
	}

}
