<?php

namespace Jason8831\DeadMessage\Events;

use Jason8831\DeadMessage\Main;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDeathEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\Config;

class PlayerDeadEvents implements Listener
{

    public function OnDead(PlayerDeathEvent $event): void
    {
        $config = new Config(Main::getInstance()->getDataFolder() . "config.yml", Config::YAML);

        $player = $event->getPlayer();
        $cause = $player->getLastDamageCause();
        if ($player instanceof Player) {
            switch ($cause->getCause()) {
                case EntityDamageEvent::CAUSE_ENTITY_ATTACK:
                    if ($cause instanceof EntityDamageByEntityEvent) {
                            $damager = $cause->getDamager();
                        if ($damager instanceof Player) {
                            $message = str_replace(["{player}", "{killer}", "{health}", "{max_health}"], [$event->getPlayer()->getName(), $damager->getName(), $damager->getHealth(), $damager->getMaxHealth()], $config->get("DeadByPlayer"));
                            $event->setDeathMessage($message);
                        }
                    }
                    break;
                case
                EntityDamageEvent::CAUSE_FALL:
                    $message = str_replace(["{player}"], [$player->getName()], $config->get("DeadByFall"));
                    $event->setDeathMessage($message);
                    break;
                case EntityDamageEvent::CAUSE_FIRE:
                    $message = str_replace(["{player}"], [$player->getName()], $config->get("DeadByFire"));
                    $event->setDeathMessage($message);
                    break;
                case EntityDamageEvent::CAUSE_LAVA:
                    $message = str_replace(["{player}"], [$player->getName()], $config->get("DeadByLava"));
                    $event->setDeathMessage($message);
                    break;
                case EntityDamageEvent::CAUSE_ENTITY_EXPLOSION:
                    $message = str_replace(["{player}"], [$player->getName()], $config->get("DeadByExplosion"));
                    $event->setDeathMessage($message);
                    break;
                case EntityDamageEvent::CAUSE_MAGIC:
                    $message = str_replace(["{player}"], [$player->getName()], $config->get("DeadByMagic"));
                    $event->setDeathMessage($message);
                    break;
                case EntityDamageEvent::CAUSE_STARVATION:
                    $message = str_replace(["{player}"], [$player->getName()], $config->get("DeadByNoFood"));
                    $event->setDeathMessage($message);
                    break;
                case EntityDamageEvent::CAUSE_SUFFOCATION:
                    $message = str_replace(["{player}"], [$player->getName()], $config->get("DeadBySuffocation"));
                    $event->setDeathMessage($message);
                    break;
                case EntityDamageEvent::CAUSE_SUICIDE:
                    $message = str_replace(["{player}"], [$player->getName()], $config->get("DeadBySucide"));
                    $event->setDeathMessage($message);
                    break;
                case EntityDamageEvent::CAUSE_VOID:
                    $message = str_replace(["{player}"], [$player->getName()], $config->get("DeadByVoid"));
                    $event->setDeathMessage($message);
                    break;
            }
        }
    }
}
