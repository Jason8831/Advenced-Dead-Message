<?php

namespace Jason8831\DeadMessage;

use Jason8831\DeadMessage\Events\PlayerDeadEvents;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener
{

    public Config $config;

    /**
     * @var Main
     */
    private static $instance;

    public function onEnable(): void
    {

        self::$instance = $this;

        $this->getLogger()->info("§f[§l§4Advenced Dead Message§r§f]: activée");
        $this->saveResource("config.yml");

        $this->getServer()->getPluginManager()->registerEvents(new PlayerDeadEvents(), $this);
    }

    public static function getInstance(): self{
        return self::$instance;
    }

}