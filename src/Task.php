<?php
class Task
{
    private $description;
    private $category_id;
    private $id;

    function __construct($description, $id = null, $category_id)
    {
        $this->description = $description;
        $this->id = $id;
        $this->category_id = $category_id;
    }

    function getId()
    {
        return $this->id;
    }

    function setId($new_id)
    {
        $this->id = (int) $new_id;
    }

    function setDescription($new_description)
    {
        $this->description = (string) $new_description;
    }

    function getDescription()
    {
        return $this->description;
    }

    function setCategoryId($new_category_id)
    {
        $this->category_id = (int) $new_category_id;
    }

    function getCategoryId()
    {
        return $this->category_id;
    }

    function save()//This function creates a new entry in our tables and ties the 'id #' to each object.
    {
        $statement = $GLOBALS['DB']->query("INSERT INTO tasks (description, category_id) VALUES ('{$this->getDescription()}', {$this->getCategoryId()}) RETURNING id;");
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $this->setId($result['id']);
    }

    static function getAll()
    {
        $returned_tasks = $GLOBALS['DB']->query("SELECT * FROM tasks;");//Pulls raw info from Database
        $tasks = array();//Creates empty destination array
        foreach($returned_tasks as $task) {//Operates on each value of returned data.
            $description = $task['description'];// Takes values from DB and sets a new variable name.
            $id = $task['id'];
            $category_id = $task['category_id'];
            $new_task = new Task($description, $id, $category_id);// Places each value in a new Category array.
            array_push($tasks, $new_task);
        }
        return $tasks;
    }

    static function find($search_id)
    {
        $found_task = null;//sets the variable to a null value.
        $tasks = Task::getAll();//calls the result of the getAll function and sets it to the variable
        foreach($tasks as $task) {//verifies the match between the requested value and the existing data
            $task_id = $task->getId();
            if ($task_id == $search_id) {
                $found_task = $task;
            }
        }
        return $found_task;
    }

    static function deleteAll()//Clears all values from Database
    {
        $GLOBALS['DB']->exec("DELETE FROM tasks *;");
    }
}
?>
