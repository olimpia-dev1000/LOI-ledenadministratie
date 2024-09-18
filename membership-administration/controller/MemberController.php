<?php

include_once 'EntityController.php';
include_once 'OptionsController.php';
include_once 'model/DatabaseModel.php';

class MemberController extends EntityController
{
    private function getOptions()
    {
        $families = OptionsController::index('family', 'family_id', 'surname');
        $familyMemberTypes = OptionsController::index('family_member_type', 'family_member_type_id', 'description');
        $memberTypes = OptionsController::index('member_type', 'member_type_id', 'description');

        return [
            'families' => $families,
            'familyMemberTypes' => $familyMemberTypes,
            'memberTypes' => $memberTypes,
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
        $options = array_merge($options, $this->getOptions());
        parent::add($options);
    }
    public function show($id, $options = [])
    {
        if (!is_array($options)) {
            $options = [];
        }
        $options = array_merge($options, $this->getOptions());
        parent::show($id, $options);
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
