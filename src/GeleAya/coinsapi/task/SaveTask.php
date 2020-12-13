<?php

namespace GeleAya\coinsapi\task;

use GeleAya\coinsapi\CoinsAPI;

use pocketmine\scheduler\Task;

class SaveTask extends Task {
    private $plugin;
	public function __construct(CoinsAPI $plugin){
		$this->plugin = $plugin;
	}

	public function onRun(int $currentTick){
		$this->plugin->saveAll();
	}
}
