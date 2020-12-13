<?php

namespace GeleAya\coinsapi\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\Player;

use GeleAya\coinsapi\CoinsAPI;

class GiveMoneyCommand extends Command{
	private $plugin;

	public function __construct(CoinsAPI $plugin){
		$desc = $plugin->getCommandMessage("givecoins");
		parent::__construct("givecoins", $desc["description"], $desc["usage"]);

		$this->setPermission("coins.givecoins");

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

		$result = $this->plugin->addMoney($player, $amount);
		switch($result){
			case CoinsAPI::RET_INVALID:
			$sender->sendMessage($this->plugin->getMessage("givecoins-invalid-number", [$amount], $sender->getName()));
			break;
			case CoinsAPI::RET_SUCCESS:
			$sender->sendMessage($this->plugin->getMessage("givecoins-gave-coins", [$amount, $player], $sender->getName()));

			if($p instanceof Player){
				$p->sendMessage($this->plugin->getMessage("givecoins-coins-given", [$amount], $sender->getName()));
			}
			break;
			case CoinsAPI::RET_CANCELLED:
			$sender->sendMessage($this->plugin->getMessage("request-cancelled", [], $sender->getName()));
			break;
			case CoinsAPI::RET_NO_ACCOUNT:
			$sender->sendMessage($this->plugin->getMessage("player-never-connected", [$player], $sender->getName()));
			break;
		}
        return true;
	}
}
