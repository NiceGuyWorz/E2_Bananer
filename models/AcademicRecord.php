<?php
// models/AcademicRecord.php

require_once '../config/db.php';

class AcademicRecord
{
    private $pdo;

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }

    // Get academic history of a student
    public function getAcademicHistory($studentNumber)
    {
        $stmt = $this->pdo->prepare('
            SELECT s.Periodo, c.Codigo_Curso, c.Nombre_Curso, n.Nota, n.Calificacion, n.Resultado
            FROM inscripcion i
            INNER JOIN seccion s ON i.Seccion_ID = s.Seccion_ID
            INNER JOIN curso c ON s.Codigo_Curso = c.Codigo_Curso
            INNER JOIN nota n ON i.Numero_Estudiante = n.Numero_Estudiante AND s.Seccion_ID = n.Seccion_ID
            WHERE i.Numero_Estudiante = :studentNumber
            ORDER BY s.Periodo ASC
        ');
        $stmt->execute(['studentNumber' => $studentNumber]);
        $records = $stmt->fetchAll();

        // Organize data by period
        $history = [];
        foreach ($records as $record) {
            $period = $record['Periodo'];
            if (!isset($history[$period])) {
                $history[$period] = [];
            }
            $history[$period][] = $record;
        }

        // Calculate summaries
        $summaries = [];
        $totalApproved = $totalFailed = $totalCurrent = 0;
        $totalSumGrades = $totalCourses = 0;

        foreach ($history as $period => $courses) {
            $approved = $failed = $current = 0;
            $sumGrades = $coursesCount = 0;

            foreach ($courses as $course) {
                $coursesCount++;
                if ($course['Resultado'] === 'Aprobatorio') {
                    $approved++;
                } elseif ($course['Resultado'] === 'Reprobatorio') {
                    $failed++;
                } else {
                    $current++;
                }
                $sumGrades += $course['Nota'];
            }

            $summaries[$period] = [
                'approved' => $approved,
                'failed'   => $failed,
                'current'  => $current,
                'pps'      => $coursesCount ? $sumGrades / $coursesCount : 0,
            ];

            $totalApproved += $approved;
            $totalFailed += $failed;
            $totalCurrent += $current;
            $totalSumGrades += $sumGrades;
            $totalCourses += $coursesCount;
        }

        $overallSummary = [
            'approved' => $totalApproved,
            'failed'   => $totalFailed,
            'current'  => $totalCurrent,
            'ppa'      => $totalCourses ? $totalSumGrades / $totalCourses : 0,
        ];

        // Determine student status
        $status = $this->getStudentStatus($studentNumber);

        return [
            'history'        => $history,
            'summaries'      => $summaries,
            'overallSummary' => $overallSummary,
            'status'         => $status,
        ];
    }

    // Get student status
    public function getStudentStatus($studentNumber)
    {
        // Check if the student took courses in the current period
        $currentPeriod = $this->getCurrentPeriod();
        $stmt = $this->pdo->prepare('
            SELECT COUNT(*) FROM inscripcion i
            INNER JOIN seccion s ON i.Seccion_ID = s.Seccion_ID
            WHERE i.Numero_Estudiante = :studentNumber AND s.Periodo = :currentPeriod
        ');
        $stmt->execute([
            'studentNumber'  => $studentNumber,
            'currentPeriod' => $currentPeriod,
        ]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            return 'Vigente';
        } else {
            // Additional logic to determine if the student is 'No vigente' or 'Término'
            return 'No vigente';
        }
    }

    // Get current academic period
    private function getCurrentPeriod()
    {
        // Logic to determine the current period, e.g., '2024-2'
        return '2024-2';
    }

    // Additional methods as needed
}
