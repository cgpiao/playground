<?php
//////////////////////////////////////////////////////////////////////////////
// Example1: Query Builder

class Person {
   public $name;
}
class Page
{
   private $title;

   private $author;


   private $comments = [];

   /**
    * @var \DateTime
    */
   private $date;

   // +100 private fields.
   public function __get($property)
   {
      if (property_exists($this, $property)) {
         return $this->$property;
      }
   }

   public function __set($property, $value)
   {
      if (property_exists($this, $property)) {
         $this->$property = $value;
      }

      return $this;
   }
   public function __construct(string $title, Person $author)
   {
      $this->title = $title;
      $this->author = $author;
      $this->date = new \DateTime();
   }

   public function addComment(string $comment): void
   {
      $this->comments[] = $comment;
   }


   public function __clone()
   {
      $this->title = "Copy of " . $this->title;
      // When an object is cloned, PHP will perform a shallow copy of all of the object's properties.
      // Any properties that are references to other variables will remain references.
      $this->author = clone $this->author;
      $this->comments = [];
      $this->date = new \DateTime();
   }
}

$person1 = new Person();
$person1->name = 'bill';
$page = new Page("title", $person1);
$page->addComment("hello world!");
$page2 = clone $page;
echo serialize($page).PHP_EOL;
echo serialize($page2).PHP_EOL;
$comments = $page->comments;
echo spl_object_id($page).PHP_EOL;
echo spl_object_id($page2).PHP_EOL;
echo '-------------------------------------'.PHP_EOL;
echo spl_object_id($page->author).PHP_EOL;
echo spl_object_id($page2->author).PHP_EOL;
