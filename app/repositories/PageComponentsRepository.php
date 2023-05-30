<?php

class PageComponentsRepository
{
    /**
     * @throws Exception
     */
    public static function table()
    {
        $sql = <<<MySQL
        CREATE TABLE IF NOT EXISTS `page_components` (`id` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, `page_id` integer NOT NULL, `component_id` integer NOT NULL, `order` integer NOT NULL, `is_visible` integer NOT NULL,
        CONSTRAINT fk_pc_pages
        FOREIGN KEY (page_id)
        REFERENCES pages(id)
        ON DELETE CASCADE,
        CONSTRAINT fk_pc_components
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
    public static function getComponentsByPageId($pageId)
    {
        $sql =<<<MySQL
      SELECT * FROM `page_components` WHERE page_id = '$pageId' ORDER BY `order`
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
      SELECT * FROM `page_components` WHERE `id` = '$id'
MySQL;

        $result = Database::getInstance()->query($sql);

        return $result->fetchArray(SQLITE3_ASSOC);
    }

    /**
     * @throws Exception
     */
    public static function create($pageId, $componentId, $order, $isVisible)
    {
        $sql =<<<MySQL
      INSERT INTO `page_components` (`page_id`, `component_id`, `order`, `is_visible`) VALUES ('$pageId', '$componentId', '$order', '$isVisible');
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
    public static function updateOrderColumn($id, $order)
    {
        $sql =<<<MySQL
     UPDATE `page_components` SET `order` = '$order' WHERE `id` = '$id';
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
    public static function deleteById($id)
    {
        $sql = <<<MySQL
        DELETE FROM `page_components` WHERE `id` = '$id';
MySQL;

        $result = Database::getInstance()->exec($sql);

        if ($result) {
            return true;
        }

        throw new Exception(Database::getInstance()->lastErrorMsg());
    }
}