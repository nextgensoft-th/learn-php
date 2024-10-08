<?php

namespace Core;

use Database\Sql\Database;

/**
 * Class Model
 * @package Core
 */
abstract class Model extends Database
{
    /**
     * @var mixed
     */
    protected mixed $config;

    public function __construct()
    {
        $app_config = require base_path('/config/database.php');
        $this->config = $app_config['app'];
        parent::__construct($this->config['config'], $this->config['engine'], $this->config['secret']['username'], $this->config['secret']['password']);
    }

    /**
     * @return false|array
     */
    public function all(): false|array
    {
        return $this->query("SELECT * FROM {$this->table} ")->get();
    }

    /**
     * @param $id
     * @return false|array
     */
    public function find($id): false|array
    {
        return $this->query("SELECT * FROM {$this->table} ", 'WHERE id = :id', ['id' => $id])->findOrFail();
    }

    /**
     * @param $key
     * @param $value
     * @return Model
     */
    public function where($key, $value): Model
    {
        return $this->query("SELECT * FROM {$this->table} ","WHERE {$key} = :{$key}", [$key => $value]);
    }

    /**
     * @param array $data
     * @return void
     */
    public function create(array $data): void
    {
        $keys = implode(',', array_keys($data));
        $values = implode(',', array_map(fn($key) => ":{$key}", array_keys($data)));
        $this->query("INSERT INTO {$this->table}", "({$keys}) VALUES ({$values})", $data);
    }

    public function update($id, array $data): void
    {
        $set = implode(',', array_map(fn($key) => "{$key} = :{$key}", array_keys($data)));
        $this->query("UPDATE {$this->table} SET ", "{$set} WHERE id = :id", array_merge($data, ['id' => $id]));
    }

    /**
     * @param $id
     * @return void
     */
    public function destroy($id): void
    {
        $this->query("DELETE FROM {$this->table} ", "WHERE id = :id", ['id' => $id]);
    }

    /**
     * @param $table
     * @param $foreign_key
     * @return Model
     */
    public function oneToOne($table, $foreign_key): Model
    {
        return $this->query("JOIN {$table} ON {$table}.id = {$this->table}.{$foreign_key}");
    }

    /**
     * @param $table
     * @param $foreign_key
     * @return Model
     */
    public function oneToMany($table, $foreign_key): Model
    {
        return $this->query("JOIN {$table} ON {$table}.{$foreign_key} = {$this->table}.id");
    }
}