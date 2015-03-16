<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Task.php";

    $DB = new PDO('pgsql:host=localhost;dbname=to_do');

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {

        return $app['twig']->render('tasks.php', array('tasks' => Task::getALL()));
    });

    $app->post("/tasks", function() use ($app) {
        $task = new Task($_POST['description']);
        $task->save();

        return $app['twig']->render('create_task.php', array('newtask' => $task));

    });

    $app->post("/delete_tasks", function() use ($app) {
        Task::deleteAll();
        return $app['twig']->render('delete_tasks.php');
    });

    return $app;
?>
