<?php
include_once 'OptionsController.php';
include_once 'model/DatabaseModel.php';

class HomeController
{
    function index()
    {
        $financialYears = OptionsController::index('financial_year', 'financial_year_id', 'description');
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['financial_year'])) {
            list($financialYearId, $financialYearDescription) = explode('|', $_POST['financial_year']);
        } else {
            $financialYearId = $financialYears[0]['financial_year_id'] ?? null;
            $financialYearDescription = $financialYears[0]['description'] ?? null;
        }
        $_SESSION['financial_year_id'] = rtrim($financialYearId);
        $_SESSION['financial_year_description'] = rtrim($financialYearDescription);
        $data = $this->countContribution($financialYearDescription, $financialYearId);
        include('view/home.php');
    }
    public function showAll()
    {
        $data = [];
        $members = new DatabaseModel('family_member');
        $families = new DatabaseModel('family');
        $contributions = new DatabaseModel('contribution');
        $data['members_array'] = $members->getAll();
        $data['families_array'] = $families->getAll();
        $data['contributions_array'] = $contributions->getAll();
        return $data;
    }
    private function countContribution($year, $yearId)
    {
        $data = $this->showAll();
        $dataNew = [];
        $totalContribution = 0;
        $familyContributions = [];
        $contributionModel = new DatabaseModel('contribution');
        $contributions = $contributionModel->getAllById($yearId, 'financial_year_id');
        $now = new DateTime($year . '-01-01');
        foreach ($data['members_array'] as $member) {
            $birthday = new DateTime($member['birthday']);
            $age = $now->diff($birthday)->y;
            $memberTypeId = $member['member_type_id'];
            $familyId = $member['family_id'];
            $memberFirstName = $member['first_name'];
            $contribution = $this->findContribution($contributions, $age, $memberTypeId);
            $amountToPay = $contribution['amount'] * (1 - $contribution['discount']);
            $formattedAmount = $this->formatEuro($amountToPay);

            $dataNew[$member['family_member_id']] = [
                'first_name' => $memberFirstName,
                'age' => $age,
                'member_type_id' => $memberTypeId,
                'family_id' => $familyId,
                'contribution_amount' => $amountToPay,
                'formatted_contribution' => $formattedAmount
            ];
            $totalContribution += $amountToPay;
            if (!isset($familyContributions[$familyId])) {
                $familyContributions[$familyId] = [
                    'total' => 0
                ];
            }
            $familyContributions[$familyId]['total'] += $amountToPay;
        }
        foreach ($familyContributions as $familyId => &$family) {
            $family['formatted_total'] = $this->formatEuro($family['total']);
        }
        $result = [
            'families_array' => $data['families_array'],
            'members' => $dataNew,
            'families' => $familyContributions,
            'total_contribution' => $totalContribution,
            'formatted_total_contribution' => $this->formatEuro($totalContribution)
        ];
        return $result;
        include('view/home.php');
        unset($_SESSION['financial_year_id'], $_SESSION['financial_year_description']);
    }

    private function findContribution($contributions, $age, $memberTypeId)
    {
        foreach ($contributions as $contribution) {
            if (
                $contribution['member_type_id'] == $memberTypeId &&
                $age >= $contribution['age_min'] &&
                $age <= $contribution['age_max']
            ) {
                return $contribution;
            }
        }
        return ['amount' => 0, 'discount' => 0];
    }
    private function formatEuro($number)
    {
        return '€ ' . number_format($number, 2, ',', '.');
    }
}
