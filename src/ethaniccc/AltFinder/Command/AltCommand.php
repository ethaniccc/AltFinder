<?php

namespace ethaniccc\AltFinder\Command;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\PluginIdentifiableCommand;
use pocketmine\plugin\Plugin;
use pocketmine\utils\TextFormat;
use pocketmine\utils\MainLogger;
use ethaniccc\AltFinder\Main;

class AltCommand extends Command implements PluginIdentifiableCommand{

    /**
     * @var Plugin
     */
    private $plugin;

    public function __construct(string $name, Plugin $plugin, string $description = "", ?string $usageMessage = null, array $aliases = []){
        parent::__construct($name, $description, $usageMessage, $aliases);
        $this->plugin = $plugin;
        $this->setDescription("See if other players are playing on the same IP as the target!");
    }
	
	public function execute(CommandSender $sender, string $commandLabel, array $args){
    	if($sender instanceof Player){
			if(!empty($args[0])){
				$target = Server::getInstance()->getServer()->getPlayer($args[0]);
				if($target instanceof Player){
					$ip = $target->getAddress();
					foreach(Server::getInstance()->getOnlinePlayers() as $other){
						if($other->getAddress() === $ip){
							$players[] = $other->getName();
							$otherip = $player->getAddress();
							$all = count($players);
							$sender->sendMessage(TextFormat::BOLD . TextFormat::GREEN . $number . TextFormat::WHITE . " player(s) are playing on the IP " . $ip . "! Names: " . TextFormat::YELLOW . implode(", ", $players));
						}
					}
				} else {
					$sender->sendMessage(TextFormat::RED . "That player is not online!");
				}
			} else {
				$sender->sendMessage(TextFormat::BOLD . TextFormat::RED . "Please give valid arguments! /alt <player>");
			}
		} else {
			if(!empty($args[0])){
				$target = Server::getInstance()->getServer()->getPlayer($args[0]);
				if($target instanceof Player){
					$ip = $target->getAddress();
					foreach($sender->getServer()->getOnlinePlayers() as $other){
						if($other->getAddress() === $ip){
							$players[] = $other->getName();
							$otherip = $player->getAddress();
							$all = count($players);
							Server::getInstance()->getLogger()->info(TextFormat::BOLD . TextFormat::GREEN . $number . TextFormat::WHITE . " player(s) are playing on the IP " . $ip . "! Names: " . TextFormat::YELLOW . implode(", ", $players));
						}
					}
				} else {
					Server::getInstance()->getLogger()->info(TextFormat::RED . "Please give a valid player!");
				}
			} else {
				Server::getInstance()->getLogger()->info("Please give a player as an argument!");
			}
		}
	}
	
	public function getPlugin(): Plugin{
        return $this->plugin;
	}
}