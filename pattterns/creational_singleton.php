<?php
abstract class AbstractSingleton
{
   private static $instances = [];
   protected function __construct()
   {
   }
   protected function __clone()
   {
   }
   public function __wakeup()
   {
      throw new \Exception("Cannot unserialize singleton");
   }

   public static function getInstance()
   {
      $subclass = static::class;
      if (!isset(self::$instances[$subclass])) {
         self::$instances[$subclass] = new static();
      }
      return self::$instances[$subclass];
   }
}
class Logger extends AbstractSingleton
{
}
$logger1 = Logger::getInstance();
$logger2 = Logger::getInstance();
echo $logger1 === $logger2;
