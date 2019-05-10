<?php

class QueryBilder {
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function selectAll($table) {
        $sql = "SELECT * FROM {$table}";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function selectOne($table, $id) {
        $sql = "SELECT * FROM {$table} WHERE id={$id}";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function update($table, $data, $id) {
        $string = '';
        foreach($data as $key => $val){
            $string .= $key . '=:' . $key . ',';
        }
        $string = rtrim($string, ',');
        $data['id'] = $id;
        $sql = "UPDATE {$table} SET {$string} WHERE id=:id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
    }
    
    public function create($table, $data) {
        $keys = implode(',', array_keys($data));
        $tags = ":" . implode(', :', array_keys($data));
        
        $sql = "INSERT INTO {$table} ({$keys}) VALUES ({$tags})";

        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
    }
    
    public function delete($table, $id) {
        $sql = "DELETE FROM {$table} WHERE id={$id}";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
    }
    
}