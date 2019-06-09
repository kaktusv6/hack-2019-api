<?php

class Database {
  static $mysql = null;

  static $host = 'localhost';
  static $username = 'kaktusv6_hack';
  static $password = 'Mamont500';
  static $database = 'kaktusv6_hack';

  static private function initConnection() {
    if (!self::$mysql) {
      self::$mysql = new mysqli(self::$host, self::$username, self::$password, self::$database);
    }
  }

  static function getMySql() {
    self::initConnection();
    return self::$mysql;
  }

  static function closeConnection() {
    return mysqli_close(self::$mysql);
  }
}
