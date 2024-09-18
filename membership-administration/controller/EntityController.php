<?php
include_once 'model/DatabaseModel.php';
class EntityController
{
    protected $entity, $view;
    public function __construct($entity, $view)
    {
        $this->entity = $entity;
        $this->view = $view;
    }
    public function index($options = [])
    {
        $entities = (new DatabaseModel($this->entity))->getAll();
        if (isset($options)) extract($options);
        include("view/{$this->view}.php");
    }
    public function show($id, $options = [])
    {
        $entity = (new DatabaseModel($this->entity))->getById($id);
        if (isset($options)) extract($options);
        $_SESSION["{$this->entity}_id"] = $id;
        include("view/{$this->view}-edit.php");
    }
    public function showById($id, $column, $options = [])
    {
        $entities = (new DatabaseModel($this->entity))->getAllById($id, $column);
        if (isset($options)) extract($options);
        $_SESSION[$column] = $id;
        include("view/{$this->view}.php");
    }
    public function edit($options = [])
    {
        if (isset($options)) extract($options);
        if ($_POST) {
            $success = (new DatabaseModel($this->entity))->edit($_SESSION["{$this->entity}_id"], $this->sanitizeInput($_POST));
            $this->setMessage($success ? "Data updated!" : "Error!", $success ? "{$this->entity} was successfully updated" : "Something went wrong! Try again.", $success ? 'green' : 'red');
            $this->redirectAfter(2);
        }
        include("view/{$this->view}-edit.php");
        $this->unsetMessage();
    }
    public function add($options = [])
    {
        if (isset($options)) extract($options);
        if (isset($_POST['submit']) && $_POST['submit'] === 'add') {
            $success = (new DatabaseModel($this->entity))->add($this->sanitizeInput($_POST));
            $this->setMessage($success ? "Data added!" : "Oops!", $success ? "{$this->entity} was successfully added" : "Something went wrong! Try once again.", $success ? 'green' : 'red');
            $this->redirectAfter(2);
        }
        include("view/{$this->view}-add.php");
        $this->unsetMessage();
    }
    public function delete($id, $options = [])
    {
        if (isset($options)) extract($options);
        if (!isset($_SESSION['confirm']) || $_SESSION['delete_id'] != $id) {
            $_SESSION['confirm'] = 'delete';
            $_SESSION['delete_id'] = $id;
            $_SESSION['options_entity'] = $_POST['options_entity'] ?? null;;
            $this->redirectAfter(0);
        } elseif (isset($_POST['confirm']) && $_POST['confirm'] == 'CANCEL') {
            unset($_SESSION['confirm'], $_SESSION['delete_id'], $_SESSION['options_entity']);
            $this->redirectAfter(0);
        } else {
            $result = (new DatabaseModel($this->entity))->delete($id);
            $this->setMessage(
                $result[0] ? "Data deleted!" : "Error!",
                $result[0] ? "{$this->entity} was successfully deleted" : $result[1],
                $result[0] ? 'green' : 'red'
            );
            $this->redirectAfter(2);
            unset($_SESSION['confirm'], $_SESSION['delete_id'], $_SESSION['options_entity']);
        }
        include("view/{$this->view}.php");
        $this->unsetMessage();
    }
    protected function sanitizeInput($input)
    {
        return array_map('htmlspecialchars', $input);
    }
    protected function setMessage($header, $message, $color)
    {
        $_SESSION['msg_header'] = $header;
        $_SESSION['msg'] = ucfirst(str_replace('_', ' ', $message));
        $_SESSION['msg_color'] = $color;
    }
    protected function redirectAfter($seconds, $url = null)
    {
        header($url ? "Refresh: $seconds; URL=$url" : "Refresh: $seconds");
    }
    protected function unsetMessage()
    {
        unset($_SESSION['msg_header'], $_SESSION['msg'], $_SESSION['msg_color'], $_SESSION["{$this->entity}_id"]);
    }
}
