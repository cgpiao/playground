<?php

class FileReader {
   public function read(string $fileName): string {
      return file_get_contents($fileName);
   }
}
class CipherMachine {
   public function encrypt(string $plaintext): string {
      echo 'CipherMachine encrypt plain text'.PHP_EOL;
      return 'CipherMachine encrypt '.$plaintext;
   }
}
class NewCipherMachine {
   public function encrypt(string $plaintext): string {
      echo 'NewCipherMachine encrypt plain text'.PHP_EOL;
      return 'NewCipherMachine encrypt '.$plaintext;
   }
}
class FileWriter {
   public function write(string $fileName, string $content): void {
      file_put_contents($fileName, $content);
   }
}
abstract class AbstractEncryptFacade {
   public abstract function fileEncrypt(string $fileNameSrc, string $fileNameDesc): void;
}
class EncryptFacade extends AbstractEncryptFacade{
   public FileReader $reader;
   public NewCipherMachine $cipherMachine;
   public FileWriter $writer;
   public function __construct() {
      $this->reader = new FileReader();
      $this->cipherMachine = new NewCipherMachine();
      $this->writer = new FileWriter();
   }

   public function fileEncrypt(string $fileNameSrc, string $fileNameDesc): void {
      $plainStr = $this->reader->read($fileNameSrc);
      $encryptStr = $this->cipherMachine->encrypt($plainStr);
      $this->writer->write($fileNameDesc, $encryptStr);
   }
}
$encryptFacade = new EncryptFacade();
$encryptFacade->fileEncrypt(__DIR__.'/creational_singleton.php', __DIR__.'/creational_singleton_enc.php');