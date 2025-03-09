<?php

class Matrix {

}
interface ImageImpInterface {
   public function doPaint(Matrix $matrix): void;
}
abstract class AbstractImage {
   protected ImageImpInterface $imp;

   function setImageImp(ImageImpInterface $imp): void {
      $this->imp = $imp;
   }
   public abstract function parseFile(string $filename): void;
}
class WindowsImp implements ImageImpInterface {
   public function doPaint(Matrix $matrix): void {
      echo 'Do Paint on Windows'.PHP_EOL;
   }
}
class LinuxImp implements ImageImpInterface {
   public function doPaint(Matrix $matrix): void {
      echo 'Do Paint on Linux'.PHP_EOL;
   }
}
class UnixImp implements ImageImpInterface {
   public function doPaint(Matrix $matrix): void {
      echo 'Do Paint on Unix'.PHP_EOL;
   }
}
class JpgImage extends AbstractImage {
   public function parseFile(string $filename): void {
      // Simulate parsing a JPG file and getting a Matrix object
      $matrix = new Matrix();
      $this->imp->doPaint($matrix);
      echo "Parsing and displaying JPG file: $filename" . PHP_EOL;
   }
}
class PngImage extends AbstractImage {
   public function parseFile(string $filename): void {
      // Simulate parsing a PNG file and getting a Matrix object
      $matrix = new Matrix();
      $this->imp->doPaint($matrix);
      echo "Parsing and displaying PNG file: $filename" . PHP_EOL;
   }
}

$image = new JpgImage();
$os = new WindowsImp();
$image->setImageImp($os);
$image->parseFile('abcd.text');