<?php

class DocumentsRepository
{
    const STATUS_NEW = 0;
    const STATUS_NEEDS_CHANGES = 1;
    const STATUS_ACCEPTED = 2;

    /**
     * @throws Exception
     */
    public static function table()
    {
        $sql = <<<MySQL
        CREATE TABLE IF NOT EXISTS `users` (`id` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, `username` text NOT NULL, `password` text NOT NULL, `is_admin` INTEGER NOT NULL); 
        CREATE TABLE IF NOT EXISTS `documents` (`id` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, `name` text NOT NULL, `content` text NOT NULL, `status` INTEGER NOT NULL, `created_at` text NOT NULL, `valid_till` text);
        CREATE TABLE IF NOT EXISTS `document_change_requests` (`id` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, `content` text NOT NULL, `user_id` INTEGER NOT NULL, `document_id` INTEGER NOT NULL, `created_at` text NOT NULL, CONSTRAINT fk_dcr_documents
        FOREIGN KEY (document_id)
        REFERENCES documents(id)
        ON DELETE CASCADE, 
        CONSTRAINT fk_dcr_users
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE);
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
        DELETE FROM `documents` WHERE `id` = '$id';
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
    public static function create($name, $content, $status, $createdAt, $validTill)
    {
        $sql =<<<MySQL
      INSERT INTO `documents` (`name`, `content`, `status`, `created_at`, `valid_till`) VALUES ('$name', '$content', '$status', '$createdAt', '$validTill');
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
    public static function createChangeRequest($content, $documentId, $userId, $date)
    {
        $sql =<<<MySQL
      INSERT INTO `document_change_requests` (`content`, `document_id`, `user_id`, `created_at`) VALUES ('$content', '$documentId', '$userId', '$date');
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
    public static function edit($id, $name, $content, $validTill)
    {
        $sql =<<<MySQL
UPDATE `documents` SET `name` = '$name', `content` = '$content', `valid_till` = '$validTill' WHERE `id` = '$id';
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
    public static function accept($id, $date)
    {
        $status = self::STATUS_ACCEPTED;

        $sql =<<<MySQL
UPDATE `documents` SET `status` = '$status', `valid_till` = '$date' WHERE `id` = '$id';
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
    public static function setChangesRequired($id)
    {
        $status = self::STATUS_NEEDS_CHANGES;

        $sql =<<<MySQL
UPDATE `documents` SET `status` = '$status' WHERE `id` = '$id';
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
    public static function setNew($id)
    {
        $status = self::STATUS_NEW;

        $sql =<<<MySQL
UPDATE `documents` SET `status` = '$status' WHERE `id` = '$id';
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
      SELECT * FROM `documents`
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
    public static function getChangeRequests($id)
    {
        $sql =<<<MySQL
      SELECT * FROM `document_change_requests` WHERE `document_id` = '$id'
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
    public static function getAccepted()
    {
        $status = self::STATUS_ACCEPTED;

        $sql =<<<MySQL
      SELECT * FROM `documents` WHERE `status` = '$status'
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
    public static function getWaiting()
    {
        $status = self::STATUS_NEW;

        $sql =<<<MySQL
      SELECT * FROM `documents` WHERE `status` = '$status'
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
    public static function getToChange()
    {
        $status = self::STATUS_NEEDS_CHANGES;

        $sql =<<<MySQL
      SELECT * FROM `documents` WHERE `status` = '$status'
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
      SELECT * FROM `documents` WHERE id = '$id'
MySQL;

        $result = Database::getInstance()->query($sql);

        return $result->fetchArray(SQLITE3_ASSOC);
    }
}