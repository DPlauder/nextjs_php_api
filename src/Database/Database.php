<?php
namespace Dp\Database;
use PDO;
use PDOStatement;
use PDOException;

class Database extends PDO{
    public function __construct(string $dsn, string $username, string $password, array $options = []){
        $default = [
            PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION
        ];
        parent::__construct($dsn, $username, $password, array_replace($default, $options));
    }
        public function sql_execute(string $sql, array $bindings = []): PDOStatement{
            if(! $bindings){
                return $this->query($sql);
            }
            $stmt = $this->prepare($sql);
            foreach($bindings as $key => $value){
                if(is_int($value)){
                    $stmt->bindValue($key, $value, PDO::PARAM_INT);
                }
                else{
                    $stmt->bindValue($key, $value, PDO::PARAM_STR);
                }
            }
            try{
                $stmt->execute();
            }
            catch(PDOException $e){
                echo $e->getMessage();
                exit;
            }
            return $stmt;
        }
}

