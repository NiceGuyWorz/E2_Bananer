<?php
// models/Student.php

require_once '../config/db.php';

class Student
{
    private $pdo;

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }

    // Get student by number
    public function getStudentByNumber($studentNumber)
    {
        $stmt = $this->pdo->prepare('
            SELECT e.*, p.*
            FROM estudiante e
            INNER JOIN persona p ON e.RUN = p.RUN
            WHERE e.Numero_Estudiante = :studentNumber
        ');
        $stmt->execute(['studentNumber' => $studentNumber]);
        return $stmt->fetch();
    }

    // Check if the student is active in a given period
    public function isActiveInPeriod($studentNumber, $period)
    {
        $stmt = $this->pdo->prepare('
            SELECT COUNT(*) FROM inscripcion i
            INNER JOIN seccion s ON i.Seccion_ID = s.Seccion_ID
            WHERE i.Numero_Estudiante = :studentNumber AND s.Periodo = :period
        ');
        $stmt->execute([
            'studentNumber' => $studentNumber,
            'period'        => $period,
        ]);
        return $stmt->fetchColumn() > 0;
    }

    // Additional methods as needed
}
