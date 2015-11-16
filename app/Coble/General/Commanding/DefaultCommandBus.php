<?php
namespace Coble\General\Commanding;

use Illuminate\Foundation\Application;


class DefaultCommandBus implements CommandBus
{
	protected $commandTranslator;

	protected $app;


	public function __construct(Application $app, CommandTranslator $translator)
	{
		$this->app = $app;

		$this->commandTranslator = $translator;
	}


	public function execute($command)
	{
		// translate DTO to handler class
		$handler = $this->commandTranslator->toCommandHandler($command);

		// resolve handler class out of the IoC container and call handle method on resolved handler class
		return $this->app->make($handler)->handle($command);
	}
	
}
