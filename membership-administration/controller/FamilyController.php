<?php

include_once 'EntityController.php';
include_once 'model/DatabaseModel.php';


class FamilyController extends EntityController
{

    private function getOptions()
    {
        $familyMembers = OptionsController::index('family_member', 'family_id', 'first_name');

        return [
            'familyMembers' => $familyMembers,
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
}
