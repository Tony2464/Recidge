<?php

require_once __DIR__ . '/../includes/path.php';
require_once(DATABASE);
require_once(SERVICES_PATH . 'Ingredient.php');

class RecipeIngredient
{
    private $table = [
        '`recipeingredient`',
        '`ingredient`'
    ];

    private $columns = [
        '`recipeId`',
        '`ingredientId`',
        '`quantity`',
    ];

    public function __construct()
    {
    }

    /**
     * Create one user's ingredient
     */
    public function create(int $recipeId, int $ingredientId, float $quantity)
    {
        $db = new DataBaseManager();
        $query = 'INSERT INTO ' . $this->table[0] . '(' . $this->columns[0] . ', ' . $this->columns[1] . ', ' . $this->columns[2] . ') VALUES (?, ?, ?)';
        return $db->executePrepare($query, [$recipeId, $ingredientId, $quantity]);
    }

    /**
     * Read all user's ingredients
     */
    public function read($recipeId)
    {
        $db = new DataBaseManager();
        $query = 'SELECT * FROM ' . $this->table[0] . ' WHERE ' . $this->columns[0] . ' = ?';
        $ingredientIds = $db->executePrepare($query, [$recipeId]);

        $ingredients = [];
        $ingredient = new Ingredient();
        $query = 'SELECT * FROM ' . $this->table[0] . ' WHERE ' . $this->columns[0] . ' = ?';

        foreach ($ingredientIds as $ingredientId) {
            array_push($ingredients, $ingredient->read_single($ingredientId['ingredientId']));
        }

        return $ingredients;
    }

    // public function read_single(int $recipeId)
    // {
    //     // $db = new DataBaseManager();
    //     // // SELECT * FROM `user` WHERE `recipeId` = ?
    //     // $query = 'SELECT * FROM ' . $this->table . 'WHERE ' . $this->recipeId . ' = ?';
    //     // $results = $db->executePrepare($query, [$recipeId]);
    //     // return $results;
    // }

    /**
     * Update one user's ingredient
     */
    public function update(int $recipeId, int $ingredientId, float $quantity)
    {
        $db = new DataBaseManager();
        $query = "UPDATE " . $this->table[0] . " SET " . $this->columns[2] . " = ? WHERE " . $this->table[0] . "." . $this->columns[0] . " = ? AND " . $this->table[0] . "." . $this->columns[1] . " = ?";
        return $db->executePrepare($query, [$quantity, $recipeId, $ingredientId]);
    }

    /**
     * Delete one user's ingredient
     */
    public function delete(int $recipeId, int $ingredientId)
    {
        $db = new DatabaseManager();
        $query = 'DELETE FROM' . $this->table[0] . 'WHERE' . $this->table[0] . '.' . $this->columns[0] . ' = ? AND ' . $this->table[0] . '.' . $this->columns[1] . ' = ?';
        $db->executePrepare($query, [$recipeId, $ingredientId]);
    }
}
