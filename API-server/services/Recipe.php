<?php

require_once __DIR__ . '/../includes/path.php';
require_once(DATABASE);
require_once(SERVICES_PATH . 'Ingredient.php');

class Recipe
{
    private $table = [
        '`recipe`'
    ];

    private $columns = [
        '`recipeId`',
        '`userId`',
        '`name`',
        '`person`',
        '`cookingTime`',
        '`preparationTime`',
        '`difficulty`',
        '`note`',
    ];

    public function __construct()
    {
    }

    /**
     * Create one user's recipe
     */
    public function create(
        int $userId,
        string $name,
        int $person,
        $cookingTime,
        $preparationTime,
        int $difficulty,
        string $note
    ) {
        $db = new DataBaseManager();
        $recipeId = $db->getLastInsertId();
        $query = 'INSERT INTO ' .
            $this->table[0] .
            '(' .
            $this->columns[0] . ', ' .
            $this->columns[1] . ', ' .
            $this->columns[2] . ', ' .
            $this->columns[3] . ', ' .
            $this->columns[4] . ', ' .
            $this->columns[5] . ', ' .
            $this->columns[6] . ', ' .
            $this->columns[7] .
            ') 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
        return $db->executePrepare($query, [
            $recipeId,
            $userId,
            $name,
            $person,
            $cookingTime,
            $preparationTime,
            $difficulty,
            $note
        ]);
    }

    /**
     * Read all user's recipes
     */
    public function read($userId)
    {
        $db = new DataBaseManager();
        $query = 'SELECT * FROM ' . $this->table[0] . ' WHERE ' . $this->columns[1] . ' = ?';
        return $db->executePrepare($query, [$userId]);
    }

    /**
     * Read one user's recipe
     */
    public function read_single(int $userId, int $recipeId)
    {
        $db = new DataBaseManager();
        $query = 'SELECT * FROM ' . $this->table[0] . 'WHERE ' . $this->columns[0] . ' = ? AND ' . $this->columns[1] . ' = ?';
        $results = $db->executePrepare($query, [$recipeId, $userId]);
        return $results;
    }

    /**
     * Update one user's ingredient
     */
    public function update(
        int $recipeId,
        string $name = null,
        int $person = null,
        $cookingTime = null,
        $preparationTime = null,
        int $difficulty = null,
        string $note = null
    ) {
        $db = new DataBaseManager();
        $query =
            "UPDATE " .
            $this->table[0] .
            " SET " .
            $this->columns[2] . " = ?, " .
            $this->columns[3] . " = ?, " .
            $this->columns[4] . " = ?, " .
            $this->columns[5] . " = ?, " .
            $this->columns[6] . " = ?, " .
            $this->columns[7] . " = ? " .
            " WHERE " .
            $this->table[0] . "." .
            $this->columns[0] .
            " = ?";
        return $db->executePrepare($query, [
            $name,
            $person,
            $cookingTime,
            $preparationTime,
            $difficulty,
            $note,
            $recipeId
        ]);
    }

    /**
     * Delete one user's ingredient
     */
    public function delete(int $userId, int $recipeId)
    {
        $db = new DatabaseManager();
        $query = 'DELETE FROM' . $this->table[0] . 'WHERE' . $this->table[0] . '.' . $this->columns[0] . ' = ? AND ' . $this->table[0] . '.' . $this->columns[1] . ' = ?';
        $db->executePrepare($query, [$recipeId, $userId]);
    }
}
