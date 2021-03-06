<?php

namespace App;

use App\ConsoleCommands;

class ConsoleCommandFactory
{
    /**
     * Directory where commands files are placed.
     */
    protected const COMMANDS_NAMESPACE = 'App\ConsoleCommands\\';

    /**
     * Class name partial to be added to $option to
     * obtain full command class name.
     */
    protected const COMMAND_CLASS_PARTIAL = 'ConsoleCommand';

    /**
     * Find and launch corresponding command in app\ConsoleCommands directory.
     *
     * @param string $command
     *
     * @return mixed
     */
    public static function make($command, $option, $optionValue)
    {
        $className = self::COMMANDS_NAMESPACE . ucfirst($command) . self::COMMAND_CLASS_PARTIAL;
        if (class_exists($className) && $className::OPTION === $option) {
            return new $className();
        }

        $className = self::COMMANDS_NAMESPACE . ucfirst('help') . self::COMMAND_CLASS_PARTIAL;

        return new $className();
    }
}