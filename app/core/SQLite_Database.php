<?php

/**Should only be used in dev */

class SQLite_Database implements Database_Interface{

    private static object $db;
    private static string $table_construction;
    public function __construct(string $path)
    {
        try {
            SQLite_Database::$table_construction = file_get_contents($path);
            SQLite_Database::$db = new SQLite3(Application::$working_directory."/app/db/dev.db");
            SQLite_Database::$db->query(SQLite_Database::$table_construction);
        }
        catch (Exception $e) {
            echo "Failed: " . $e->getMessage();
        }
        
    }
    public function search(string $table, array $data): mixed
    {
        $imploded_keys = '';
        foreach (array_keys($data) as $key) {
            $imploded_keys .= $key .' = :' . $key;
            if ($key !== array_key_last($data))
            $imploded_keys .= ', ';
        }
        
        $stmt = SQLite_Database::$db->prepare("SELECT * from $table WHERE $imploded_keys;");
        foreach(array_keys($data) as $key) {
            $stmt->bindValue(":". $key, $data[$key], SQLITE3_TEXT);
        }
        return $stmt->execute();
    }   
    
    public function create($table, array $data): mixed
    {
        $keys = [];
        foreach(array_keys($data) as $key) {
            $keys[] = $key; 
        }

        $imploded_keys = implode(', ', $keys);
        $imploded_key_values = ':' . implode(', :', $keys);

        $stmt = SQLite_Database::$db->prepare("INSERT INTO $table ($imploded_keys) VALUES ($imploded_key_values);");
        foreach(array_keys($data) as $key) {
            $stmt->bindValue(':' . $key, $data[$key], SQLITE3_TEXT);
        }
        return $stmt->execute();
    }

    public function update(string $table, array $data): void
    {

    }

    public function delete(string $table, array $data): void
    {

    }
}