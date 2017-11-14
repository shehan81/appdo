<?php

class DB {

    private $pdo;
    private static $instance;
    private $host = 'localhost';
    private $db = 'appdo';

    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {

        try {
            // Put your database information
            $this->pdo = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db . "", "root", "");
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function connect() {
        return $this->pdo;
    }

    public static function getModelTable() {
        $class = get_called_class();
        if (!$class::$table_name) {
            throw new Exception('Error table name!');
        }
        return $class::$table_name;
    }

    public static function all() {
        $tbl = self::getModelTable();
        return self::selectAll("SELECT * FROM {$tbl}");
    }

    public static function where($conditions) {
        $tbl = self::getModelTable();
        $sql = "SELECT * FROM {$tbl}";

        $where = [];
        if (!empty($conditions)) {
            foreach ($conditions as $condition) {
                $w = $condition[0];

                if (isset($condition[2])) {
                    $w .= ' ' . $condition[1] . '  "' . $condition[2] . '"';
                } else {
                    $w .= ' =  "' . $condition[1] . '"';
                }

                $where[] = $w;
            }

            $where = join(" AND ", $where);

            if (!empty($where)) {
                $sql .= ' WHERE ' . $where;
            }
        }

        return self::select($sql);
    }
    
    public static function find($id, $field = "") {
        $tbl = self::getModelTable();
        $id_fld = empty($field) ? 'id' : $field;
        return self::select("SELECT * FROM {$tbl} WHERE {$id_fld} = {$id}");
    }

    public static function select($sql) {
        $db = self::getInstance()->connect();
        $stmt = $db->query($sql);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public static function selectAll($sql) {
        $db = self::getInstance()->connect();
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

}
