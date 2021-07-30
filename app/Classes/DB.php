<?php


namespace App\Classes;


use Medoo\Medoo;
use PDO;

class DB implements \App\Contracts\DB
{
    protected $table = '';

    /** @var PDO $connection */
    public $connection;

    /** @var Medoo $orm */
    public $orm;

    public function __construct(Medoo $orm = null)
    {
        $config = Helper::config('database');
        $this->orm = $orm ?? new Medoo($config);
    }

    public function store(array $attributes)
    {
        $this->orm->insert($this->table, $attributes);

        return $this->find($this->orm->id());
    }

    /**
     * @param $id
     * @param string|array $columns
     * @return false|array|string
     */
    public function find($id, $columns = '*')
    {
        return $this->orm->get($this->table, $columns, compact('id'));
    }
}
