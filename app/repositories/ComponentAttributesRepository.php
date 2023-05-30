<?php

class ComponentAttributesRepository
{
    /**
     * @throws Exception
     */
    public static function table()
    {
        $sql = <<<MySQL
            CREATE TABLE IF NOT EXISTS `component_attributes` (`id` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, `page_component_id` integer NOT NULL, `attribute_id` integer NOT NULL, `language_id` integer NOT NULL, `value` text NOT NULL,
        CONSTRAINT fk_ca_page_components
        FOREIGN KEY (page_component_id)
        REFERENCES page_components(id)
        ON DELETE CASCADE,
        CONSTRAINT fk_ca_attributes
        FOREIGN KEY (attribute_id)
        REFERENCES attributes(id)
        ON DELETE CASCADE,
        CONSTRAINT fk_ca_languages
        FOREIGN KEY (language_id)
        REFERENCES languages(id)
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
    public static function create($page_component_id, $attribute_id, $language_id, $value)
    {
        $sql =<<<MySQL
      INSERT INTO `component_attributes` (`page_component_id`, `attribute_id`, `language_id`, `value`) VALUES ('$page_component_id', '$attribute_id', '$language_id', '$value');
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
    public static function edit($id, $language_id, $value)
    {
        $sql =<<<MySQL
UPDATE `component_attributes` SET `language_id` = '$language_id', `value` = '$value' WHERE `id` = '$id';
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
    public static function getByPageComponentId($pageComponentId)
    {
        $sql =<<<MySQL
      SELECT * FROM `component_attributes` WHERE `page_component_id` = '$pageComponentId'
MySQL;

        $result = Database::getInstance()->query($sql);

        $rows = [];
        while($row = $result->fetchArray(SQLITE3_ASSOC) ) {
            $rows[] = $row;
        }

        return $rows;
    }
}