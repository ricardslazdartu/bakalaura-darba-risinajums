<?php

class UsersRepository
{
    const REGULAR_USER = 0;
    const EDITOR_USER = 1;
    const ADMIN_USER = 2;
    /**
     * @throws Exception
     */
    public static function table()
    {
        $sql = <<<MySQL
        CREATE TABLE IF NOT EXISTS `users` (`id` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, `username` text NOT NULL, `password` text NOT NULL, `role` INTEGER NOT NULL);
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
    public static function create($username, $password, $role)
    {
        $sql =<<<MySQL
      INSERT INTO `users` (`username`, `password`, `role`) VALUES ('$username', '$password', '$role');
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
    public static function getUser($username)
    {
        $sql =<<<MySQL
      SELECT * FROM `users` WHERE `username` = '$username'
MySQL;

        $result = Database::getInstance()->query($sql);

        return $result->fetchArray(SQLITE3_ASSOC);
    }
}