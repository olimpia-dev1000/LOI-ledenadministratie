<?php

include_once 'EntityController.php';
include_once 'model/DatabaseModel.php';


class ConfigurationController extends EntityController
{

    private function getOptions()
    {
        $financialYears = OptionsController::index('financial_year', 'financial_year_id', 'description');
        $memberTypes = OptionsController::index('member_type', 'member_type_id', 'description');
        $familyMemberTypes = OptionsController::index('family_member_type', 'family_member_type_id', 'description');

        return [
            'financialYears' => $financialYears,
            'memberTypes' => $memberTypes,
            'familyMemberTypes' => $familyMemberTypes

        ];
    }

    public function index($options = [])
    {
        if (!is_array($options)) {
            $options = [];
        }
        $options = array_merge($options, $this->getOptions());
        parent::index($options);
    }

    public function add($options = [])
    {

        if (!is_array($options)) {
            $options = [];
        }

        if ($_POST['submit'] != 'add') {
            $_SESSION['entity'] = str_replace(' ', '_', str_replace('Add ', '', $_POST['submit']));
        }

        $options = array_merge($options, $this->getOptions());
        parent::add($options);
    }

    public function delete($id, $options = [])
    {
        if (!is_array($options)) {
            $options = [];
        }
        $options = array_merge($options, $this->getOptions());
        parent::delete($id, $options);
    }

    public function show($id, $options = [])
    {

        unset($_SESSION['entity']);
        if (!is_array($options)) {
            $options = [];
        }
        $_SESSION['entity'] = $_POST['options_entity'];
        $options = array_merge($options, $this->getOptions());
        parent::show($id, $options);
    }

    public function edit($options = [])
    {
        if (!is_array($options)) {
            $options = [];
        }
        $options = array_merge($options, $this->getOptions());
        parent::edit($options);
    }
}
