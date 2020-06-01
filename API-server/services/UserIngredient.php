<?php

require_once __DIR__ . '/../includes/path.php';
require_once(DATABASE);
require_once(SERVICES_PATH . 'Ingredient.php');

class UserIngredient
{
    private $table = [
        '`useringredient`',
        '`ingredient`'
    ];

    private $columns = [
        '`userId`',
        '`ingredientId`',
        '`quantity`',
    ];

    public function __construct()
    {
    }

    /**
     * Create one user's ingredient
     */
    public function create(int $userId, int $ingredientId, float $quantity)
    {
        $db = new DataBaseManager();
        $query = 'INSERT INTO ' . $this->table[0] . '(' . $this->columns[0] . ', ' . $this->columns[1] . ', ' . $this->columns[2] . ') VALUES (?, ?, ?)';
        return $db->executePrepare($query, [$userId, $ingredientId, $quantity]);
    }

    /**
     * Read all user's ingredients
     */
    public function read($userId)
    {
        $db = new DataBaseManager();
        $query = 'SELECT * FROM ' . $this->table[0] . ' WHERE ' . $this->columns[0] . ' = ?';
        $ingredientIds = $db->executePrepare($query, [$userId]);

        $ingredients = [];
        $ingredient = new Ingredient();
        $query = 'SELECT * FROM ' . $this->table[0] . ' WHERE ' . $this->columns[0] . ' = ?';

        foreach ($ingredientIds as $ingredientId) {
            array_push($ingredients, $ingredient->read_single($ingredientId['ingredientId']));
        }

        return $ingredients;
    }

    // public function read_single(int $userId)
    // {
    //     // $db = new DataBaseManager();
    //     // // SELECT * FROM `user` WHERE `userId` = ?
    //     // $query = 'SELECT * FROM ' . $this->table . 'WHERE ' . $this->userId . ' = ?';
    //     // $results = $db->executePrepare($query, [$userId]);
    //     // return $results;
    // }

    /**
     * Update one user's ingredient
     */
    public function update(int $userId, int $ingredientId, float $quantity)
    {
        $db = new DataBaseManager();
        //UPDATE `useringredient` SET `quantity` = '2' WHERE                          `useringredient`.`userId` = 2 AND `useringredient`.`ingredientId` = 1 
        $query = "UPDATE " . $this->table[0] . " SET " . $this->columns[2] . " = ? WHERE " . $this->table[0] . "." . $this->columns[0] . " = ? AND " . $this->table[0] . "." . $this->columns[1] . " = ?";
        return $db->executePrepare($query, [$quantity, $userId, $ingredientId]);
    }

    /**
     * Delete one user's ingredient
     */
    public function delete(int $userId, int $ingredientId)
    {
        $db = new DatabaseManager();
        $query = 'DELETE FROM' . $this->table[0] . 'WHERE' . $this->table[0] . '.' . $this->columns[0] . ' = ? AND ' . $this->table[0] . '.' . $this->columns[1] . ' = ?';
        $db->executePrepare($query, [$userId, $ingredientId]);
    }
}
