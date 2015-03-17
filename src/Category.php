<?php
    class Category
    {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function getId()
        {
            return $this->id;
        }

        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }

        function save()//This function creates a new entry in our tables and ties the 'id #' to each object.
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO categories (name) VALUES ('{$this->getName()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        static function getAll()//
        {
            $returned_categories = $GLOBALS['DB']->query("SELECT * FROM categories;");//Pulls raw info from Database
            $categories = array();//Creates empty destination array
            foreach($returned_categories as $category) { //Operates on each value of returned data.
                $name = $category['name'];// Takes values from DB and sets a new variable name.
                $id = $category['id'];// Same as above*
                $new_category = new Category($name, $id);// Places each value in a new Category array.
                array_push($categories, $new_category);
            }
            return $categories;
        }

        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM categories *;");//Clears all values from Database
        }

        static function find($search_id)
        {
            $found_category = null;
            $categories = Category::getAll();
            foreach($categories as $category) {
                $category_id = $category->getId();
                if ($category_id == $search_id) {
                  $found_category = $category;
                }
            }
            return $found_category;
        }
    }
?>
