<?php

class AttributesRepository
{
    /**
     * @throws Exception
     */
    public static function table()
    {
        $sql = <<<MySQL
        CREATE TABLE IF NOT EXISTS `attributes` (`id` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, `component_id` integer NOT NULL, `key` text NOT NULL, UNIQUE(`component_id`, `key`),
        CONSTRAINT fk_a_components
        FOREIGN KEY (component_id)
        REFERENCES components(id)
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
    public static function create($componentId, $key)
    {
        $sql =<<<MySQL
      INSERT INTO `attributes` (`component_id`, `key`) VALUES ('$componentId', '$key');
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
    public static function getByComponentId($componentId)
    {
        $sql =<<<MySQL
      SELECT * FROM `attributes` WHERE `component_id` = '$componentId'
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
      SELECT * FROM `attributes` WHERE `id` = '$id'
MySQL;

        $result = Database::getInstance()->query($sql);

        return $result->fetchArray(SQLITE3_ASSOC);
    }

    /**
     * @throws Exception
     */
    public static function deleteByComponentId($component_id)
    {
        $sql = <<<MySQL
        DELETE FROM `attributes` WHERE `component_id` = '$component_id';
MySQL;

        $result = Database::getInstance()->exec($sql);

        if ($result) {
            return true;
        }

        throw new Exception(Database::getInstance()->lastErrorMsg());
    }
}