<?php

namespace GeleAya\coinsapi\provider;

use GeleAya\coinsapi\CoinsAPI;

interface Provider{
	public function __construct(CoinsAPI $plugin);

	public function open();

	/**
	 * @param \pocketmine\Player|string $player
	 * @return bool
	 */
	public function accountExists($player);

	/**
	 * @param \pocketmine\Player|string $player
	 * @param float $defaultMoney
	 * @return bool
	 */
	public function createAccount($player, $defaultMoney = 1000);

	/**
	 * @param \pocketmine\Player|string $player
	 * @return bool
	 */
	public function removeAccount($player);

	/**
	 * @param string $player
	 * @return float|bool
	 */
	public function getMoney($player);

	/**
	 * @param \pocketmine\Player|string $player
	 * @param float $amount
	 * @return bool
	 */
	public function setMoney($player, $amount);

	/**
	 * @param \pocketmine\Player|string $player
	 * @param float $amount
	 * @return bool
	 */
	public function addMoney($player, $amount);

	/**
	 * @param \pocketmine\Player|string $player
	 * @param float $amount
	 * @return bool
	 */
	public function reduceMoney($player, $amount);

	/**
	 * @return array
	 */
	public function getAll();

	/**
	 * @return string
	 */
	public function getName();

	public function save();
	public function close();
}
