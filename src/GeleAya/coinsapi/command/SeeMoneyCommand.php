<?php

namespace GeleAya\coinsapi\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\Player;

use GeleAya\coinsapi\CoinsAPI;

class SeeMoneyCommand extends Command{
	private $plugin;

	public function __construct(CoinsAPI $plugin){
		$desc = $plugin->getCommandMessage("seecoins");
		parent::__construct("seecoins", $desc["description"], $desc["usage"]);

		$this->setPermission("coins.seecoins");

		$this->plugin = $plugin;
	}

	public function execute(CommandSender $sender, string $label, array $params): bool{
		if(!$this->plugin->isEnabled()) return false;
		if(!$this->testPermission($sender)){
			return false;
		}

		$player = array_shift($params);
		if(trim($player) === ""){
			$sender->sendMessage(TextFormat::RED . "Usage: " . $this->getUsage());
			return true;
		}

		if(($p = $this->plugin->getServer()->getPlayer($player)) instanceof Player){
			$player = $p->getName();
		}

		$money = $this->plugin->myMoney($player);
		if($money !== false){
			$sender->sendMessage($this->plugin->getMessage("seecoins-seecoins", [$player, $money], $sender->getName()));
		}else{
			$sender->sendMessage($this->plugin->getMessage("player-never-connected", [$player], $sender->getName()));
		}
		return true;
	}
}
