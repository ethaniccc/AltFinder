<?php

declare(strict_types=1);

namespace ethaniccc\AltFinder;

use pocketmine\plugin\PluginBase;
use pocketmine\plugin\Plugin;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\Player;
use pocketmine\Server;

use pocketmine\permission\Permission;

use pocketmine\utils\MainLogger;
use pocketmine\utils\TextFormat;

use ethaniccc\AltFinder\Command\AltCommand;

class Main extends PluginBase{

	public $altfinder;

	public function onEnable(){
		$this->loadCommands();
		
	}

	private function loadCommands(){
		$commandMap = $this->getServer()->getCommandMap();
		$commandMap->register($this->getName(), new AltCommand("alt", $this));
		$this->addPerms([
            new Permission('find.alt', 'Find online players with the same IP!', Permission::DEFAULT_OP)
        ]);
	}
	
	protected function addPerms(array $permissions){
		foreach($permissions as $permission){
			$this->getServer()->getPluginManager()->addPermission($permission);
		}
	}

}
