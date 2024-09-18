<?php

include_once 'EntityController.php';
include_once 'model/DatabaseModel.php';


class ContributionController extends EntityController
{

    private function getOptions()
    {
        $memberTypes = OptionsController::index('member_type', 'member_type_id', 'description');
        $financialYears = OptionsController::index('financial_year', 'financial_year_id', 'description');

        return [
            'memberTypes' => $memberTypes,
            'financialYears' => $financialYears,
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

    public function showById($id, $column, $options = [])
    {
        if (!is_array($options)) {
            $options = [];
        }
        $options = array_merge($options, $this->getOptions());
        parent::showById($id, $column, $options);
    }

    public function show($id, $options = [])
    {
        if (!is_array($options)) {
            $options = [];
        }
        $options = array_merge($options, $this->getOptions());
        parent::show($id, $options);
    }
    public function add($options = [])
    {
        if (!is_array($options)) {
            $options = [];
        }
        $options = array_merge($options, $this->getOptions());
        parent::add($options);
    }
}
