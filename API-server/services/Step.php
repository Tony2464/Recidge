<?php

require_once __DIR__ . '/../includes/path.php';
require_once(DATABASE);

class Step
{
    private $table = [
        '`step`'
    ];

    private $columns = [
        '`stepId`',
        '`recipeId`',
        '`order`',
        '`description`'
    ];

    public function __construct()
    {
    }

    /**
     * Create one step
     */
    public function create(int $recipeId, int $order, string $description)
    {
        $db = new DataBaseManager();
        $stepId = $db->getLastInsertId();
        $query =
            'INSERT INTO ' .
            $this->table[0] .
            '(' .
            $this->columns[0] . ', ' .
            $this->columns[1] . ', ' .
            $this->columns[2] . ', ' .
            $this->columns[3] .
            ') 
            VALUES (?, ?, ?, ?)';
        return $db->executePrepare($query, [$stepId, $recipeId, $order, $description]);
    }

    /**
     * Get all recipe's steps
     */
    public function read(int $recipeId)
    {
        $db = new DataBaseManager();
        $query = 'SELECT * FROM ' . $this->table[0] . ' WHERE ' . $this->columns[1] . ' = ?';
        return $db->executePrepare($query, [$recipeId]);
    }

    /**
     * Get one recipe's step
     */
    public function read_single(int $ingredientId)
    {
        // $db = new DataBaseManager();
        // $query = 'SELECT * FROM ' . $this->table[0] . 'WHERE ' . $this->columns[0] . ' = ?';
        // $results = $db->executePrepare($query, [$ingredientId]);
        // return $results;
    }

    /**
     * Update one step
     */
    public function update(int $stepId, int $order, string $description)
    {
        $db = new DataBaseManager();
        $query =
            "UPDATE " .
            $this->table[0] .
            " SET " .
            $this->columns[2] . " = ?, " .
            $this->columns[3] . " = ? WHERE " .
            $this->table[0] . "." .
            $this->columns[0] . " = ? ";
        return $db->executePrepare($query, [$order, $description, $stepId]);
    }

    /**
     * Delete one step
     */
    public function delete(int $stepId)
    {
        $db = new DatabaseManager();
        $query = 'DELETE FROM' . $this->table[0] . 'WHERE' . $this->table[0] . '.' . $this->columns[0] . ' = ?';
        $db->executePrepare($query, [$stepId]);
    }
}
