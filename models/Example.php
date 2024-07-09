<?php

namespace Model;

use Model\ActiveRecord;

class Example extends ActiveRecord
{

    protected static $table = 'articles';
    protected static $columnsDB = ['id', 'title', 'image', 'description', 'date', 'time', 'author'];

    public $id;
    public $title;
    public $image;
    public $description;
    public $date;
    public $time;
    public $author;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->title = $args['title'] ?? '';
        $this->image = $args['image'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->date = date('y/m/d');
        $this->time = date('h:i:s');
        $this->author = $_SESSION['name'] ?? '';
    }

    public function validate()
    {
        if (!$this->title) {
            self::$errors[] = "You must add a title";
        } else if (strlen($this->title) > 100) {
            self::$errors[] = "The title cannot exceed 100 characters in length";
        }

        if (!$this->image) {
            self::$errors[] = "Image is required";
        }

        if (!$this->description) {
            self::$errors[] = "You must add a description";
        } else if (strlen($this->description) < 50) {
            self::$errors[] = "Description must be at least 50 characters long";
        }

        return self::$errors;
    }
}
