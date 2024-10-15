<?php
// controllers/ReportController.php

session_start();

require_once '../models/Report.php';

class ReportController
{
    // Ensure the user is authenticated
    public function __construct()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ../controllers/AuthController.php?action=login');
            exit();
        }
    }

    // Display the menu of reports
    public function showMenu()
    {
        require '../views/reports/menu.php';
    }

    // Report a: Students Within and Outside Level
    public function reportStudentLevel()
    {
        $reportModel = new Report();
        $data = $reportModel->getStudentLevelReport();
        require '../views/reports/student_level_report.php';
    }

    // Report b: Course Approval Percentage by Period
    public function reportCourseApprovalByPeriod()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $period = $_POST['period'];
            $reportModel = new Report();
            $data = $reportModel->getCourseApprovalByPeriod($period);
            require '../views/reports/course_approval_report.php';
        } else {
            require '../views/reports/enter_period.php';
        }
    }

    // Report c: Historical Approval Percentage by Professor
    public function reportHistoricalApprovalByProfessor()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $courseCode = $_POST['course_code'];
            $reportModel = new Report();
            $data = $reportModel->getHistoricalApprovalByProfessor($courseCode);
            require '../views/reports/historical_approval_report.php';
        } else {
            require '../views/reports/enter_course_code.php';
        }
    }

    // Report d: Proposed Course Schedule
    public function reportProposedCourseSchedule()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $studentNumber = $_POST['student_number'];
            $reportModel = new Report();
            $data = $reportModel->getProposedCourseSchedule($studentNumber);
            require '../views/reports/proposed_schedule.php';
        } else {
            require '../views/reports/enter_student_number.php';
        }
    }

    // Report e: Academic History of a Student
    public function reportAcademicHistory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $studentNumber = $_POST['student_number'];
            $reportModel = new Report();
            $data = $reportModel->getAcademicHistory($studentNumber);
            require '../views/reports/academic_history.php';
        } else {
            require '../views/reports/enter_student_number.php';
        }
    }

    // Report f: Load Grades from CSV
    public function loadGradesFromCSV()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $courseCode = $_POST['course_code'];
            $csvFile = $_FILES['csv_file']['tmp_name'];

            if (is_uploaded_file($csvFile)) {
                $reportModel = new Report();
                $result = $reportModel->processGradesCSV($courseCode, $csvFile);
                require '../views/reports/grades_load_result.php';
            } else {
                $error = "Please upload a valid CSV file.";
                require '../views/reports/load_grades.php';
            }
        } else {
            require '../views/reports/load_grades.php';
        }
    }
}

// Router logic
$reportController = new ReportController();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'student_level':
            $reportController->reportStudentLevel();
            break;
        case 'course_approval_period':
            $reportController->reportCourseApprovalByPeriod();
            break;
        case 'historical_approval_professor':
            $reportController->reportHistoricalApprovalByProfessor();
            break;
        case 'proposed_schedule':
            $reportController->reportProposedCourseSchedule();
            break;
        case 'academic_history':
            $reportController->reportAcademicHistory();
            break;
        case 'load_grades':
            $reportController->loadGradesFromCSV();
            break;
        default:
            $reportController->showMenu();
            break;
    }
} else {
    $reportController->showMenu();
}
