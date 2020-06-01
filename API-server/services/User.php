<?php

require_once __DIR__ . '/../includes/path.php';
require_once(DATABASE);

class User
{
    private $table = '`user`';
    private $columns = [
        '`pseudo`',
        '`userId`',
        '`password`'
    ];

    public function __construct()
    {
    }
    
    /**
     * Create one user
     */
    public function create(int $pseudo, string $password)
    {
        $db = new DataBaseManager();
        $userId = $db->getLastInsertId();
        $query = 'INSERT INTO ' . $this->table . '(' . $this->columns[1] . ', ' . $this->columns[0] . ', ' . $this->columns[2] . ') VALUES (?, ?, ?)';
        return $db->executePrepare($query, [$userId, $pseudo, $password]);
    }

    /**
     * Get all users
     */
    public function read()
    {
        $db = new DataBaseManager();
        $query = 'SELECT * FROM ' . $this->table . ' ORDER BY' . $this->columns[0] . ' ASC';
        $results = $db->executePrepare($query);
        return $results;
    }

    /**
     * Read one user
     */
    public function read_single(int $userId)
    {
        $db = new DataBaseManager();
        $query = 'SELECT * FROM ' . $this->table . 'WHERE ' . $this->columns[1] . ' = ?';
        $results = $db->executePrepare($query, [$userId]);
        return $results;
    }

    /**
     * Update one user
     */
    public function update(int $userId, string $pseudo = null, string $password = null)
    {
        $db = new DataBaseManager();
        if ($pseudo != null && $password != null) {
            $query = "UPDATE " . $this->table . " SET " . $this->columns[0] . " = ?, " . $this->columns[2] . " = ? WHERE " . $this->table . "." . $this->columns[1] . " = ? ";
            return $db->executePrepare($query, [$pseudo, $password, $userId]);
        } else {
            if ($pseudo != null) {
                $query = "UPDATE " . $this->table . " SET " . $this->columns[0] . " = ? WHERE " . $this->table . "." . $this->columns[1] . " = ? ";
                return $db->executePrepare($query, [$pseudo, $userId]);
            } else {
                $query = "UPDATE " . $this->table . " SET " . $this->columns[2] . " = ? WHERE " . $this->table . "." . $this->columns[1] . " = ? ";
                return $db->executePrepare($query, [$password, $userId]);
            }
        }
    }

    /**
     * Delete one user
     */
    public function delete(int $userId)
    {
        $db = new DatabaseManager();
        $query = 'DELETE FROM' . $this->table . 'WHERE' . $this->table . '.' . $this->columns[1] . ' = ?';
        $db->executePrepare($query, [$userId]);
    }
}
