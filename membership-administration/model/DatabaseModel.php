<?php
class DatabaseModel
{
    protected $tableName;

    public function __construct($tableName)
    {
        $this->tableName = $tableName;
    }

    private function executeQuery($query, $params = [], $fetchMode = PDO::FETCH_ASSOC)
    {
        global $conn;
        try {
            $stmt = $conn->prepare($query);
            $stmt->execute($params);
            return $fetchMode ? $stmt->fetchAll($fetchMode) : true;
        } catch (PDOException $e) {
            error_log("Error in {$this->tableName}: " . $e->getMessage());
            return false;
        }
    }

    public function getAll()
    {
        return $this->executeQuery("SELECT * FROM {$this->tableName}");
    }

    public function getAllById($id, $column)
    {
        return $this->executeQuery("SELECT * FROM {$this->tableName} WHERE {$column} = ?", [$id]);
    }

    public function getOptions($option1, $option2)
    {
        return $this->executeQuery("SELECT {$option1}, {$option2} FROM {$this->tableName}");
    }
    public function getById($id)
    {
        $result = $this->executeQuery("SELECT * FROM {$this->tableName} WHERE {$this->tableName}_id = ?", [$id]);
        return $result ? $result[0] : false;
    }
    public function add($data)
    {
        global $conn;
        unset($data['action'], $data['submit'], $data['options_entity']);
        $fields = implode(', ', array_keys($data));
        $placeholders = rtrim(str_repeat('?, ', count($data)), ', ');
        try {
            $query = "INSERT INTO {$this->tableName} ({$fields}) VALUES ({$placeholders})";
            $stmt = $conn->prepare($query);

            $i = 1;
            foreach ($data as $value) {
                $stmt->bindValue($i++, $value);
            }
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Error adding record to {$this->tableName}: " . $e->getMessage());
            return false;
        }
    }
    public function edit($id, $data)
    {
        global $conn;
        unset($data['action'], $data['submit'], $data['options_entity']);
        $fields = '';
        foreach ($data as $key => $value) {
            $fields .= "$key = ?, ";
        }
        $fields = rtrim($fields, ', ');

        try {
            $query = "UPDATE {$this->tableName} SET {$fields} WHERE {$this->tableName}_id = ?";
            $stmt = $conn->prepare($query);

            $i = 1;
            foreach ($data as $value) {
                $stmt->bindValue($i++, $value);
            }
            $stmt->bindValue($i, $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Error editing record in {$this->tableName}: " . $e->getMessage());
            return false;
        }
    }
    public function delete($id)
    {
        try {
            return [$this->executeQuery("DELETE FROM {$this->tableName} WHERE {$this->tableName}_id = ?", [$id], null), null];
        } catch (PDOException $e) {
            return [$e->getCode() != '23000', $e->getCode() == '23000' ? "Delete all the related data first." : null];
        }
    }
}
