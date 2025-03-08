<?php

interface ButtonInterface
{
   public function display();
}

interface TextFieldInterface
{
   public function display();
}

class LightButton implements ButtonInterface
{
   public function display()
   {
      echo 'light Button'.PHP_EOL;
   }
}

class DarkButton implements ButtonInterface
{
   public function display()
   {
      echo 'dark Button'.PHP_EOL;
   }
}

class LightTextField implements TextFieldInterface
{
   public function display()
   {
      echo 'light TextField'.PHP_EOL;
   }
}

class DarkTextField implements TextFieldInterface
{
   public function display()
   {
      echo 'dark TextField'.PHP_EOL;
   }
}

interface SkinFactoryInterface
{
   public function createButton(): ButtonInterface;
   public function createTextField(): TextFieldInterface;
}
class LightSkinFactory implements SkinFactoryInterface
{
   public function createButton(): ButtonInterface
   {
      return new LightButton();
   }

   public function createTextField(): TextFieldInterface
   {
      return new LightTextField();
   }
}
class DarkSkinFactory implements SkinFactoryInterface
{
   public function createButton(): ButtonInterface
   {
      return new DarkButton();
   }

   public function createTextField(): TextFieldInterface
   {
      return new DarkTextField();
   }
}

$lightSkinFactory = new LightSkinFactory();
$lightButton = $lightSkinFactory->createButton();
$lightButton->display();

$darkSkinFactory = new DarkSkinFactory();
$darkTextField = $darkSkinFactory->createTextField();
$darkTextField->display();