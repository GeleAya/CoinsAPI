<?php

namespace GeleAya\coinsapi\command;

use pocketmine\event\TranslationContainer;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\Player;

use GeleAya\coinsapi\CoinsAPI;

class MyMoneyCommand extends Command{
	private $plugin;

	public function __construct(CoinsAPI $plugin){
		$desc = $plugin->getCommandMessage("coins");
		parent::__construct("coins", $desc["description"], $desc["usage"]);

		$this->setPermission("coins.coins");

		$this->plugin = $plugin;
	}

	public function execute(CommandSender $sender, string $label, array $params): bool{
		if(!$this->plugin->isEnabled()) return false;
		if(!$this->testPermission($sender)){
			return false;
		}

		if($sender instanceof Player){
			$money = $this->plugin->myMoney($sender);
			$sender->sendMessage($this->plugin->getMessage("coins-coins", [$money]));
			return true;
		}
		$sender->sendMessage(TextFormat::RED."Please run this command in-game.");
		return true;
	}
}
