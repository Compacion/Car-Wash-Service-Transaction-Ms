<?php
<?php
require_once '../models/staff.php';

class StaffController {
    private $staffModel;

    public function __construct() {
        $this->staffModel = new Staff();
    }

    public function addStaff($name, $position) {
        return $this->staffModel->createStaff($name, $position);
    }

    public function getAllStaff() {
        return $this->staffModel->fetchAllStaff();
    }
}
?>