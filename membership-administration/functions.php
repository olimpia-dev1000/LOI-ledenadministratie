<?php

// function readSqlFile($filePath, $conn)
// {
//     // Convert sql file into string variable
//     $templine = '';
//     $lines = file($filePath);

//     foreach ($lines as $line) {
//         // Skip if it is a comment
//         if (substr($line, 0, 2) == '--' || $line == '')
//             continue;
//         // Add this line to the current segment
//         $templine .= $line;
//         // If it has semicolon at the end, it is the end of the query
//         if (substr(trim($line), -1, 1) == ';') {
//             //Perform the query
//             $conn->exec($templine);
//             // Reset temp variable to empty
//             $templine = '';
//         }
//     }
// };

function sanitize($conn, $str)
{
    $str = htmlentities($str);
    return $conn->quote($str);
}

function homeDir()
{
    $path = __DIR__;
    $dir = basename($path);
    return $dir;
}

function handleAction($controller, $entity, $view, $postActionMap, $defaultMethod = 'index')
{
    $controllerInstance = new $controller($entity, $view);

    if (isset($_POST['action']) && array_key_exists($_POST['action'], $postActionMap)) {
        $method = $postActionMap[$_POST['action']]['method'];
        $paramKey = $postActionMap[$_POST['action']]['param'] ?? null;
        $param = $paramKey ? $_POST[$paramKey] : null;
        $column = $postActionMap[$_POST['action']]['column'] ?? null;;
        $controllerInstance->$method($param, $column);
    } else {
        $controllerInstance->$defaultMethod();
    }
}
