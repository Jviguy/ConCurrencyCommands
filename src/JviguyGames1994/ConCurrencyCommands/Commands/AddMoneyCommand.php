<?php
declare(strict_types=1);
namespace JviguyGames1994\ConCurrencyCommands\Commands;

use JviguyGames1994\Concurrency\Concurrency;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\utils\CommandException;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class AddMoneyCommand extends Command
{
	public function __construct()
	{
		parent::__construct("addmoney","Adds An Amount To the given Economy of the stated player");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args): bool
	{
		if (!$sender->isOp()){
			$sender->sendMessage(TextFormat::RED."Insufficient Permissions!");
			return false;
		}
		// 0 eco name 1 player name 2 float|int amount
		if(!isset($args[0]) || !isset($args[1]) || !isset($args[2])){
			$sender->sendMessage(TextFormat::RED."Invalid Arguments!");
			return false;
		}
		$econame = $args[0]; $name = $args[1]; $amount = $args[2];
		try {
			$economy = Concurrency::getInstance()->getEconomy($econame);
		} catch (\InvalidArgumentException $exception){
			$sender->sendMessage(TextFormat::RED . "Invalid Economy Name That Economy Doesnt Exist!");
			return false;
		}
		try {
			$economy->add(Server::getInstance()->getPlayer($name)->getUniqueId()->toString(), $amount);
			$sender->sendMessage(TextFormat::GREEN."Money Added To Player $name Went through successfully!");
		} catch (\InvalidArgumentException $exception){
			$sender->sendMessage(TextFormat::RED."That Player Is not registered into the economy database!");
			return false;
		}
		return true;
	}
}