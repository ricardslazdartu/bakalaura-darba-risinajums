<?php

class Database
{
    /** @var SQLite3|null */
    private static $instance = null;

    public static function getInstance()
    {
        if (!self::$instance) {
            try {
                self::$instance = new SQLite3('app.db');
                self::$instance->exec('PRAGMA foreign_keys = ON;');
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        return self::$instance;
    }
}