<?php

require_once __DIR__ . '/../includes/path.php';
require_once(CONFIG);

class DatabaseManager
{
    private $pdo;

    public function __construct()
    {
        $options = [
            'host=' . DB_HOST,
            'dbname=' . DB_NAME,
            'port=' . DB_PORT
        ];
        $this->pdo = new PDO(DB_DRIVER . ':' . join(';', $options), DB_USER, DB_PASSWORD);
    }

    public function executePrepare(string $request, array $params = null)
    {
        $stmt = $this->pdo->prepare($request);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getLastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

    /**
     * Get the value of pdo
     */
    public function getPdo()
    {
        return $this->pdo;
    }
}
