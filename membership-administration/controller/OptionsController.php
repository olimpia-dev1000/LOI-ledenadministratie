<?php
include_once 'model/DatabaseModel.php';
include_once 'EntityController.php';
include_once 'OptionsController.php';
include_once 'model/DatabaseModel.php';


class OptionsController
{
    public static function index($table, $option1, $option2)
    {
        $optionsModel = new DatabaseModel($table);
        $options = $optionsModel->getOptions($option1, $option2);

        return $options;
    }
}
