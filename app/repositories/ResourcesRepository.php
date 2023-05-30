<?php

class ResourcesRepository
{
    /**
     * @throws Exception
     */
    public static function table()
    {
        $sql = <<<MySQL
        CREATE TABLE IF NOT EXISTS `resources` (`id` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, `name` text NOT NULL);
        CREATE TABLE IF NOT EXISTS `resource_file` (`id` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, `resource_id` INTEGER NOT NULL, `path` text NOT NULL, `type` text NOT NULL, `size` INTEGER NOT NULL, CONSTRAINT fk_rf_resources
        FOREIGN KEY (resource_id)
        REFERENCES resources(id)
        ON DELETE CASCADE
        );
        CREATE TABLE IF NOT EXISTS `resource_keyword` (`id` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, `resource_file_id` INTEGER NOT NULL, `key` text NOT NULL, CONSTRAINT fk_rk_resource_files
        FOREIGN KEY (resource_file_id)
        REFERENCES resource_file(id)
        ON DELETE CASCADE
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
        DELETE FROM `resources` WHERE `id` = '$id';
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
    public static function deleteFile($id)
    {
        $sql = <<<MySQL
        DELETE FROM `resource_file` WHERE `id` = '$id';
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
    public static function create($name)
    {
        $sql =<<<MySQL
      INSERT INTO `resources` (`name`) VALUES ('$name');
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
    public static function createFile($resourceId, $path, $type, $size)
    {
        $sql =<<<MySQL
      INSERT INTO `resource_file` (`resource_id`, `path`, `type`, `size`) VALUES ('$resourceId', '$path', '$type', '$size');
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
    public static function createKeyword($fileId, $key)
    {
        $sql =<<<MySQL
      INSERT INTO `resource_keyword` (`resource_file_id`, `key`) VALUES ('$fileId', '$key');
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
    public static function edit($id, $name)
    {
        $sql =<<<MySQL
UPDATE `resources` SET `name` = '$name' WHERE `id` = '$id';
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
      SELECT * FROM `resources`
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
    public static function getFileCountAndSize($resourceId)
    {
        $sql =<<<MySQL
      SELECT COUNT(*) as `count`, SUM(`size`) as `totalSize` FROM `resource_file` WHERE `resource_id` = '$resourceId'
MySQL;

        $result = Database::getInstance()->query($sql);

        return $result->fetchArray(SQLITE3_ASSOC);
    }

    /**
     * @throws Exception
     */
    public static function getFiles($resourceId)
    {
        $sql =<<<MySQL
      SELECT * FROM `resource_file` WHERE `resource_id` = '$resourceId'
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
    public static function getFile($fileId)
    {
        $sql =<<<MySQL
      SELECT * FROM `resource_file` WHERE `id` = '$fileId'
MySQL;

        $result = Database::getInstance()->query($sql);

        return $result->fetchArray(SQLITE3_ASSOC);
    }

    /**
     * @throws Exception
     */
    public static function getKeywords($fileId)
    {
        $sql =<<<MySQL
      SELECT * FROM `resource_keyword` WHERE `resource_file_id` = '$fileId'
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
    public static function deleteKeywords($fileId)
    {
        $sql = <<<MySQL
      DELETE FROM `resource_keyword` WHERE `resource_file_id` = '$fileId'
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
    public static function getById($id)
    {
        $sql =<<<MySQL
      SELECT * FROM `resources` WHERE id = '$id'
MySQL;

        $result = Database::getInstance()->query($sql);

        return $result->fetchArray(SQLITE3_ASSOC);
    }

    /**
     * @throws Exception
     */
    public static function getByKeyword($keyword)
    {
        $sql =<<<MySQL
      SELECT * FROM `resource_keyword` WHERE `key` LIKE '%$keyword%'
MySQL;

        $result = Database::getInstance()->query($sql);

        return $result->fetchArray(SQLITE3_ASSOC);
    }
}