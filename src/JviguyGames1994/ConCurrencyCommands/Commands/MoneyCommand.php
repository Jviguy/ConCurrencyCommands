<?php
declare(strict_types=1);

namespace JviguyGames1994\ConCurrencyCommands\Commands;

use JviguyGames1994\Concurrency\Economy\EconomyHandlers;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class MoneyCommand extends Command
{
	public function __construct()
	{
		parent::__construct("seemoney", "shows a players money for a stated economy!");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args): bool
	{
		if (!isset($args[0]) || !isset($args[1])){
			$sender->sendMessage(TextFormat::RED."Invalid Arguments!");
			return false;
		}
		$ename = $args[0]; $name = $args[1];
		try {
			$con = EconomyHandlers::getInstance();
			$eco = $con->getEconomy($args[0]);
		} catch (\InvalidArgumentException $exception){
			$sender->sendMessage(TextFormat::RED . "Invalid Economy Name!");
			return false;
		}
		try {
			$money = $eco->get(Server::getInstance()->getPlayer($name)->getUniqueId()->toString());
			$sender->sendMessage(TextFormat::GREEN."Success Player: $name has $money In the Economy $ename");
		} catch (\InvalidArgumentException $exception){
			$sender->sendMessage(TextFormat::RED."Invalid Player That Player hasnt Joined or isnt registered!");
			return false;
		}
		return true;
	}
}