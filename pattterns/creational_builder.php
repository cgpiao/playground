<?php
//////////////////////////////////////////////////////////////////////////////
// Example1: Query Builder
interface QueryBuilderInterface
{
   public function select(string $table, array $fields): QueryBuilderInterface;
   public function where(string $field, string $value, string $operator = "="): QueryBuilderInterface;
   public function limit(int $limit, int $offset): QueryBuilderInterface;
   public function getSQL(): string;
}

class MySqlQueryBuilder implements QueryBuilderInterface
{
   protected $query;

   protected function reset(): void
   {
      $this->query = new stdClass();
   }

   public function select(string $table, array $fields): QueryBuilderInterface
   {
      $this->reset();
      $this->query->base = "SELECT " . implode(", ", $fields) . " FROM " . $table;
      $this->query->type = 'select';

      return $this;
   }


   public function where(string $field, string $value, string $operator = '='): QueryBuilderInterface
   {
      if (!in_array($this->query->type, ['select', 'update', 'delete'])) {
         throw new \Exception("WHERE can only be added to SELECT, UPDATE OR DELETE");
      }
      $this->query->where[] = "$field $operator '$value'";

      return $this;
   }


   public function limit(int $start, int $offset): QueryBuilderInterface
   {
      if (!in_array($this->query->type, ['select'])) {
         throw new \Exception("LIMIT can only be added to SELECT");
      }
      $this->query->limit = " LIMIT " . $start . ", " . $offset;

      return $this;
   }

   public function getSQL(): string
   {
      $query = $this->query;
      $sql = $query->base;
      if (!empty($query->where)) {
         $sql .= " WHERE " . implode(' AND ', $query->where);
      }
      if (isset($query->limit)) {
         $sql .= $query->limit;
      }
      $sql .= ";";
      return $sql;
   }

}

$mySqlQueryBuilder = new MysqlQueryBuilder();
$sql = $mySqlQueryBuilder
   ->select("users", ["name", "email", "password"])
   ->where("age", 18, ">")
   ->where("age", 30, "<")
   ->limit(10, 20)
   ->getSQL();
echo $sql;


//////////////////////////////////////////////////////////////////////////////
// Example2: Actor Builder
class Actor
{
   private string $name;
   private string $occupation;
   private string $gender;

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
}
abstract class AbstractActorBuilder
{
   public abstract function buildName(string $name): void;
   public abstract function buildOccupation(): void;
   public abstract function buildGender(string $gender): void;

   public abstract function createActor() : Actor;
}
class PaladinBuilder extends AbstractActorBuilder
{
   public function __construct(protected Actor $actor = new Actor()) {
   }
   public function createActor(): Actor
   {
      return $this->actor;
   }
   public function buildName(string $name): void
   {
      $this->actor->name = $name;
   }

   public function buildOccupation(): void
   {
      $this->actor->name = 'paladin';
   }

   public function buildGender(string $gender): void
   {
      $this->actor->name = $gender;
   }
}
$actorBuilder = new PaladinBuilder();
$actorBuilder->buildName('william');
$actorBuilder->buildGender('male');
$actorBuilder->createActor();
$actor = $actorBuilder->createActor();
echo serialize($actor). PHP_EOL;