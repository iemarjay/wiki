<?php


namespace App;


use App\Classes\DB;
use App\Classes\Helper;
use PDO;

class Donation extends DB
{
    protected $table = 'donations';

    public function migrate(PDO $pdo = null): void
    {
        $config = Helper::config('database');
        $this->connection = $pdo ?? new PDO("mysql:host={$config['host']};dbname={$config['database']}", $config['username'], $config['password']);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->connection->exec(
            "CREATE TABLE IF NOT EXISTS {$this->table} (id INT PRIMARY KEY AUTO_INCREMENT, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, street_address VARCHAR(255) NOT NULL, city VARCHAR(64) NOT NULL, country VARCHAR(64) NOT NULL, postal_code VARCHAR(12) NOT NULL, phone VARCHAR(32) NOT NULL, preferred_contact_mode VARCHAR(12) NOT NULL, amount DECIMAL(15, 2) NOT NULL, preferred_payment_option VARCHAR(12) NOT NULL, donation_interval VARCHAR(12) NOT NULL, comments VARCHAR(255), created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)"
        );
    }
}
