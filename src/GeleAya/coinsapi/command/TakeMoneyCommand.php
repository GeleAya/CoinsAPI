<?php

namespace GeleAya\coinsapi\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\Player;

use GeleAya\coinsapi\CoinsAPI;

class TakeMoneyCommand extends Command{
	private $plugin;

	public function __construct(CoinsAPI $plugin){
		$desc = $plugin->getCommandMessage("takecoins");
		parent::__construct("takecoins", $desc["description"], $desc["usage"]);

		$this->setPermission("coins.takecoins");

		$this->plugin = $plugin;
	}

	public function execute(CommandSender $sender, string $label, array $params): bool{
		if(!$this->plugin->isEnabled()) return false;
		if(!$this->testPermission($sender)){
			return false;
		}

		$player = array_shift($params);
		$amount = array_shift($params);

		if(!is_numeric($amount)){
			$sender->sendMessage(TextFormat::RED . "Usage: " . $this->getUsage());
			return true;
		}

		if(($p = $this->plugin->getServer()->getPlayer($player)) instanceof Player){
			$player = $p->getName();
		}

		if($amount < 0){
			$sender->sendMessage($this->plugin->getMessage("takecoins-invalid-number", [$amount], $sender->getName()));
			return true;
		}

		$result = $this->plugin->reduceMoney($player, $amount);
		switch($result){
			case CoinsAPI::RET_INVALID:
			$sender->sendMessage($this->plugin->getMessage("takecoins-player-lack-of-coins", [$player, $amount, $this->plugin->myMoney($player)], $sender->getName()));
			break;
			case CoinsAPI::RET_SUCCESS:
			$sender->sendMessage($this->plugin->getMessage("takecoins-took-coins", [$player, $amount], $sender->getName()));

			if($p instanceof Player){
				$p->sendMessage($this->plugin->getMessage("takecoins-coins-taken", [$amount], $sender->getName()));
			}
			break;
			case CoinsAPI::RET_CANCELLED:
			$sender->sendMessage($this->plugin->getMessage("takecoins-failed", [], $sender->getName()));
			break;
			case CoinsAPI::RET_NO_ACCOUNT:
			$sender->sendMessage($this->plugin->getMessage("player-never-connected", [$player], $sender->getName()));
			break;
		}

		return true;
	}
}
