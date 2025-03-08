<?php

interface LoggerInterface {
   public function log($message);
}
interface LoggerFactoryInterface {
   public function createLogger(): LoggerInterface;
}

class DatabaseLogger implements LoggerInterface {
   public function log($message) {
      echo 'write '.$message.' to db'.PHP_EOL;
   }
}

class DatabaseLoggerFactory implements LoggerFactoryInterface {
   public function createLogger(): LoggerInterface {
      return new DatabaseLogger();
   }
}

class FileLogger implements LoggerInterface {
   public function log($message) {
      echo 'write '.$message.' to file'.PHP_EOL;
   }
}

class FileLoggerFactory implements LoggerFactoryInterface {
   public function createLogger(): LoggerInterface {
      return new FileLogger();
   }
}

$dbLogger = new DatabaseLoggerFactory()->createLogger();
$dbLogger->log('msg');
$fileLogger = new FileLoggerFactory()->createLogger();
$fileLogger->log('msg');