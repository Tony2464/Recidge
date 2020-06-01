<?php

require_once __DIR__ . '/../includes/path.php';
require_once(DATABASE);

class Ingredient
{
    private $table = [
        '`ingredient`'
    ];

    private $columns = [
        '`ingredientId`',
        '`name`',
        '`unit`',
    ];

    public function __construct()
    {
    }

    /**
     * Create one ingredient
     */
    public function create(string $name, string $unit)
    {
        $db = new DataBaseManager();
        $userId = $db->getLastInsertId();
        $query = 'INSERT INTO ' . $this->table[0] . '(' . $this->columns[0] . ', ' . $this->columns[1] . ', ' . $this->columns[2] . ') VALUES (?, ?, ?)';
        return $db->executePrepare($query, [$userId, $name, $unit]);
    }

    /**
     * Get all ingredients
     */
    public function read()
    {
        $db = new DataBaseManager();
        $query = 'SELECT * FROM ' . $this->table[0];
        return $db->executePrepare($query);
    }

    /**
     * Get one ingredient
     */
    public function read_single(int $ingredientId)
    {
        $db = new DataBaseManager();
        $query = 'SELECT * FROM ' . $this->table[0] . 'WHERE ' . $this->columns[0] . ' = ?';
        $results = $db->executePrepare($query, [$ingredientId]);
        return $results;
    }

    /**
     * Update one ingredient
     */
    public function update(int $ingredientId, string $name = null, string $unit = null)
    {
        $db = new DataBaseManager();
        if ($name != null && $unit != null) {
            $query = "UPDATE " . $this->table[0] . " SET " . $this->columns[1] . " = ?, " . $this->columns[2] . " = ? WHERE " . $this->table[0] . "." . $this->columns[0] . " = ? ";
            return $db->executePrepare($query, [$name, $unit, $ingredientId]);
        } else {
            if ($name != null) {
                $query = "UPDATE " . $this->table[0] . " SET " . $this->columns[1] . " = ? WHERE " . $this->table[0] . "." . $this->columns[0] . " = ? ";
                return $db->executePrepare($query, [$name, $ingredientId]);
            } else {
                $query = "UPDATE " . $this->table[0] . " SET " . $this->columns[2] . " = ? WHERE " . $this->table[0] . "." . $this->columns[0] . " = ? ";
                return $db->executePrepare($query, [$unit, $ingredientId]);
            }
        }
    }

    /**
     * Delete one ingredient
     */
    public function delete(int $ingredientId)
    {
        $db = new DatabaseManager();
        $query = 'DELETE FROM' . $this->table[0] . 'WHERE' . $this->table[0] . '.' . $this->columns[0] . ' = ?';
        $db->executePrepare($query, [$ingredientId]);
    }
}
