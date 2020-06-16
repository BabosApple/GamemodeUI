<?php

namespace MulkiAqi192\Minigames;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\event\Listener;

class main extends PluginBase implements Listener {

	public function onEnable(){
		$this->getLogger("Enable! Minigames List");
	}

	public function onDisable(){
		$this->getLogger("Disable! Minigames List");
	}

	public function onCommand(CommandSender $sender, Command $cmd, String $label, Array $args) : bool {

		switch($cmd->getName()){
			case "gm":
			 if ($sender instanceof Player){
			 	if ($sender->hasPermission("pocketmine.command.gamemode")){
			 	$this->openMyForm($sender);
			 	} else {
			 		$sender->sendMessage("§cDo you know what are you doing!");
			 	}
			 }
		break;
		}
	 return true;
	}

	public function openMyForm($player){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createSimpleForm(function (Player $player, int $data = null){
			$result = $data;
			if($result === null){
				return true;
			}
			switch($result){
				case 0:
					$player->setGamemode(1);
					$player->addTitle("§dChanged Your gamemode to", "§eCreative!", 20, 20, 20);
					$player->sendMessage("§dChange your gamemode to §eCreative!");
				break;

				case 1:
					$player->setGamemode(0);
					$player->addTitle("§cChanged Your gamemode to", "§eSurvival!", 20, 20, 20);
					$player->sendMessage("§dChange your gamemode to §eSurvival!");
				break;

				case 2:
					$player->setGamemode(2);
					$player->addTitle("§dChanged Your gamemode to", "§eAdventure!", 20, 20, 20);
					if($player->getGamemode() === 2){
					$player->sendMessage("§dChange your gamemode to §eAdventure!");
					}
				break;

				case 3:
					$player->setGamemode(3);
					$player->addTitle("§dChanged Your gamemode to", "§eSpectator!", 20, 20, 20);
					if($player->getGamemode() === 3){
					$player->sendMessage("§dChange your gamemode to §eSpectator!");
					}
				break;
			}
		});
		$form->setTitle("§l§eServer §aGamemode");
		$form->setContent("Select The Gamemode you want to change!");
		$form->addButton("§cCreative");
		$form->addButton("§cSurvival");
		$form->addButton("§cAdventure");
		$form->addButton("§cSpectator");
		$form->sendToPlayer($player);
		return $form;
	}


}