<?php

declare(strict_types=1);

namespace JviguyGames1994\ConCurrencyCommands;

use JviguyGames1994\ConCurrencyCommands\Commands\AddMoneyCommand;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase{
	public function onEnable()
	{
		$cmp = $this->getServer()->getCommandMap();
		$cmp->registerAll("ConCurrencyCommands", [new AddMoneyCommand()]);
	}
}
