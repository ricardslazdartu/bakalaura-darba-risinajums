<?php

class SettingsRepository
{
    const HEADER_CONTENT_KEY = 'headerContent';

    /**
     * @throws Exception
     */
    public static function table()
    {
        $sql = <<<MySQL
        CREATE TABLE IF NOT EXISTS `settings` (`key` text PRIMARY KEY NOT NULL, `value` text NOT NULL);
MySQL;

        $result = Database::getInstance()->exec($sql);

        if ($result) {
            return true;
        }

        throw new Exception(Database::getInstance()->lastErrorMsg());
    }

    /**
     * @throws Exception
     */
    public static function create($key, $value)
    {
        $sql = <<<MySQL
      INSERT INTO `settings` (`key`, `value`) VALUES ('$key', '$value');
MySQL;

        $result = Database::getInstance()->exec($sql);

        if ($result) {
            return true;
        }

        throw new Exception(Database::getInstance()->lastErrorMsg());
    }

    /**
     * @throws Exception
     */
    public static function edit($key, $value)
    {
        $sql = <<<MySQL
UPDATE `settings` SET `value` = '$value' WHERE `key` = '$key';
MySQL;

        $result = Database::getInstance()->exec($sql);

        if ($result) {
            return true;
        }

        throw new Exception(Database::getInstance()->lastErrorMsg());
    }

    /**
     * @throws Exception
     */
    public static function get()
    {
        $sql = <<<MySQL
      SELECT * FROM `settings`
MySQL;

        $result = Database::getInstance()->query($sql);

        $rows = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $rows[] = $row;
        }

        return $rows;
    }

    /**
     * @throws Exception
     */
    public static function getByKey($key)
    {
        $sql = <<<MySQL
      SELECT * FROM `settings` WHERE `key` = '$key'
MySQL;

        $result = Database::getInstance()->query($sql);

        $rows = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $rows[] = $row;
        }

        return $rows;
    }
}