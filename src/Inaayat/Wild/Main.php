<?php

namespace Inaayat\Wild;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\level\Position;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as TF;

class Main extends PluginBase
{

    public $config;

    public function onEnable()
    {
        @mkdir($this->getDataFolder());
        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
        $this->saveResource("config.yml");
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        switch ($command->getName()) {
            case "wild":
                if($sender instanceof Player){
                    $min = $this->config->get("MinCoord");
                    $max = $this->config->get("MaxCoord");
                    $x = mt_rand($min, $max);
                    $y = mt_rand("75", "80");
                    $z = mt_rand($min, $max);
                    $world = $this->config->get("WildWorld");
                    $level = $this->getServer()->getLevelByName($world);
                    $sender->teleport(new Position($x, $y, $z, $level));
                    $sender->sendMessage("[" . TF::AQUA . "Wilderness" . TF::RESET . "] " . TF::YELLOW . " You have been teleported to a random location.");
                }
        }
        return true;
    }
}
