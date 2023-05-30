<?php

class PagesRepository
{
    /**
     * @throws Exception
     */
    public static function table()
    {
        $sql = <<<MySQL
        CREATE TABLE IF NOT EXISTS `pages` (`id` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, `name` text NOT NULL, `link` text NOT NULL, `key` text NOT NULL, `is_visible` integer NOT NULL, 
        );
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
    public static function delete($id)
    {
        $sql = <<<MySQL
        DELETE FROM `pages` WHERE `id` = '$id';
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
    public static function create($name, $link, $key, $is_visible)
    {
        $sql =<<<MySQL
      INSERT INTO `pages` (`name`, `link`, `key`, `is_visible`) VALUES ('$name', '$link', '$key', '$is_visible');
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
    public static function edit($id, $name, $link, $key, $is_visible)
    {
        $sql =<<<MySQL
UPDATE `pages` SET `name` = '$name', `link` = '$link', `key` = '$key', `is_visible` = '$is_visible' WHERE `id` = '$id';
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
        $sql =<<<MySQL
      SELECT * FROM `pages`
MySQL;

        $result = Database::getInstance()->query($sql);

        $rows = [];
        while($row = $result->fetchArray(SQLITE3_ASSOC) ) {
            $rows[] = $row;
        }

        return $rows;
    }

    /**
     * @throws Exception
     */
    public static function getById($id)
    {
        $sql =<<<MySQL
      SELECT * FROM `pages` WHERE id = '$id'
MySQL;

        $result = Database::getInstance()->query($sql);

        return $result->fetchArray(SQLITE3_ASSOC);
    }

    /**
     * @throws Exception
     */
    public static function getByKey($key)
    {
        $sql =<<<MySQL
      SELECT * FROM `pages` WHERE `key` = '$key'
MySQL;

        $result = Database::getInstance()->query($sql);

        return $result->fetchArray(SQLITE3_ASSOC);
    }

    /**
     * @throws Exception
     */
    public static function getVisibleByKey($key)
    {
        $sql =<<<MySQL
      SELECT * FROM `pages` WHERE `key` = '$key' and `is_visible` = 1
MySQL;

        $result = Database::getInstance()->query($sql);

        return $result->fetchArray(SQLITE3_ASSOC);
    }
}