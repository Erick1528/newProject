<?php

namespace Model;

class ActiveRecord
{
    // DATABASE
    protected static $db;
    protected static $columnsDB = [];
    protected static $table = '';

    // Errors
    protected static $errors = [];

    // Define DB connection
    public static function setDB($database)
    {
        self::$db = $database;
    }

    public function save()
    {
        if (!is_null($this->id)) {
            // Updating
            $this->update();
        } else {
            // Creating
            $this->create();
        }
    }

    public function create()
    {
        // Sanitize data
        $data = $this->sanitizeData();

        // Insert into the database
        $query = "INSERT INTO " . static::$table . " ( ";
        $query .= join(', ', array_keys($data));
        $query .= " ) VALUES ('";
        $query .= join("',  '", array_values($data));
        $query .= "') ";

        $result = self::$db->query($query);
        if ($result) {
            $id = self::$db->insert_id;
            return $id;
        } else {
            return false;
        }
    }

    public function update()
    {
        // Sanitize data
        $data = $this->sanitizeData();

        $values = [];
        foreach ($data as $key => $value) {
            $values[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$table . " SET ";
        $query .= join(', ', $values);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        $result = self::$db->query($query);
    }

    // Delete a record
    public function delete()
    {
        $query = "DELETE FROM " . static::$table . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";

        $result = self::$db->query($query);

        if ($result) {
            $this->deleteImage();
        }
    }

    // File upload
    public function setImage($image)
    {
        // Delete previous image
        if (!is_null($this->id)) {
            $this->deleteImage();
        }

        // Assign the image name to the image attribute
        if ($image) {
            $this->image = $image;
        }
    }

    // Delete file
    public function deleteImage()
    {
        // Check if the file exists
        $fileExists = file_exists(IMAGES_PATH . $this->image);

        if ($fileExists) {
            // Appropriate permissions to delete the image
            chmod(IMAGES_PATH . $this->image, 0777);

            // Delete the file
            unlink(IMAGES_PATH . $this->image);
        }
    }

    // Identify and merge DB data
    public function data()
    {
        $data = [];
        foreach (static::$columnsDB as $column) {
            // Ignore the id to avoid issues as it's a data we don't have yet
            if ($column === 'id') continue;
            $data[$column] = $this->$column;
        }
        return $data;
    }

    public function sanitizeData()
    {
        $data = $this->data();
        $sanitized = [];

        foreach ($data as $key => $value) {
            $sanitized[$key] = self::$db->escape_string(trim($value));
        }

        return $sanitized;
    }

    // Validation
    public static function getErrors()
    {
        return static::$errors;
    }

    public function validate()
    {
        static::$errors = [];
        return static::$errors;
    }

    // List all records
    public static function all()
    {
        $query = "SELECT * FROM " . static::$table . static::$order;

        $result = self::querySQL($query);

        return $result;
    }

    // Get a certain number of records
    public static function get($quantity)
    {
        $query = "SELECT * FROM " . static::$table . static::$order . " LIMIT " . $quantity;

        $result = self::querySQL($query);

        return $result;
    }

    // Find a record by its ID
    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$table . " WHERE id = {$id}";

        $result = self::querySQL($query);

        return array_shift($result);
    }

    // Find a record by its WHERE clause
    public static function where($column, $value)
    {
        $query = "SELECT * FROM " . static::$table . " WHERE {$column} = '{$value}'";

        $result = self::querySQL($query);

        return array_shift($result);
    }

    // Find records by their WHERE clause
    public static function getAllWhere($column, $value)
    {
        $query = "SELECT * FROM " . static::$table . " WHERE {$column} = '{$value}'";

        $result = self::querySQL($query);

        return $result;
    }

    // Raw SQL query
    public static function SQL($query)
    {
        $query = $query;
        $result = self::querySQL($query);
        return $result;
    }

    public static function querySQL($query)
    {
        // Query the DB
        $result = self::$db->query($query);

        // Iterate through results
        $array = [];
        while ($record = $result->fetch_assoc()) {
            $array[] = static::createObject($record);
        }

        // Free memory
        $result->free();

        // Return results
        return $array;
    }

    protected static function createObject($record)
    {
        $object = new static;

        foreach ($record as $key => $value) {
            if (property_exists($object, $key)) {
                $object->$key = $value;
            }
        }

        return $object;
    }

    // Synchronize the object in memory with the changes made by the user
    public function synchronize($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}
