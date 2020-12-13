<?php


namespace GeleAya\coinsapi\event\account;

use GeleAya\coinsapi\event\EconomyAPIEvent;
use GeleAya\coinsapi\CoinsAPI;

class CreateAccountEvent extends EconomyAPIEvent{
	private $username, $defaultMoney;
	public static $handlerList;
	
	public function __construct(CoinsAPI $plugin, $username, $defaultMoney, $issuer){
		parent::__construct($plugin, $issuer);
		$this->username = $username;
		$this->defaultMoney = $defaultMoney;
	}
	
	public function getUsername(){
		return $this->username;
	}
	
	public function setDefaultMoney($money){
		$this->defaultMoney = $money;
	}
	
	public function getDefaultMoney(){
		return $this->defaultMoney;
	}
}
