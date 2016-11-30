<?php

namespace Dbiagi\Composer;

use Composer\Script\Event;
use Sensio\Bundle\DistributionBundle\Composer\ScriptHandler;

class CreateSchema extends ScriptHandler {
    /**
     * Action name.
     *
     * @var string
     */
    public static $ACTION = 'create schema';

    /**
     * Create database schema.
     * @param Event $event
     */
    public static function create(Event $event) {
        static::dropDatabase($event);
        static::createDatabase($event);
        static::updateSchema($event);
        static::loadFixtures($event);
    }

    /**
     * Drop database if exists.
     * @param Event $event
     */
    public static function dropDatabase(Event $event) {
        $consoleDir = static::getConsoleDir($event, static::$ACTION);

        static::executeCommand($event, $consoleDir, 'doctrine:database:drop --force --if-exists');
    }

    /**
     * Create database if not exists.
     * @param Event $event
     */
    public static function createDatabase(Event $event) {
        $consoleDir = static::getConsoleDir($event, static::$ACTION);

        static::executeCommand($event, $consoleDir, 'doctrine:database:create --if-not-exists');
    }

    /**
     * Update database schema if needed.
     * @param Event $event
     */
    public static function updateSchema(Event $event) {
        $consoleDir = static::getConsoleDir($event, static::$ACTION);

        static::executeCommand($event, $consoleDir, 'doctrine:schema:update -f');
    }

    /**
     * Load fixtures.
     * @param Event $event
     */
    public static function loadFixtures(Event $event) {
        $consoleDir = static::getConsoleDir($event, static::$ACTION);

        static::executeCommand($event, $consoleDir, 'doctrine:fixtures:load -n --append');
    }

}