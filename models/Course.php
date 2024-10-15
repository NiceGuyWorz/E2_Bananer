<?php
// models/Course.php

require_once '../config/db.php';

class Course
{
    private $pdo;

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }

    // Get course by code
    public function getCourseByCode($courseCode)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM curso WHERE Codigo_Curso = :courseCode');
        $stmt->execute(['courseCode' => $courseCode]);
        return $stmt->fetch();
    }

    // Get courses and approval percentage for a given period
    public function getCourseApprovalByPeriod($period)
    {
        $stmt = $this->pdo->prepare('
            SELECT c.Codigo_Curso, c.Nombre_Curso, p.Nombres AS Profesor,
                   (SUM(CASE WHEN n.Resultado = "Aprobatorio" THEN 1 ELSE 0 END) / COUNT(n.Resultado)) * 100 AS Porcentaje_Aprobacion
            FROM curso c
            INNER JOIN seccion s ON c.Codigo_Curso = s.Codigo_Curso
            INNER JOIN dicta d ON s.Seccion_ID = d.Seccion_ID
            INNER JOIN academico a ON d.RUN = a.RUN
            INNER JOIN persona p ON a.RUN = p.RUN
            INNER JOIN nota n ON s.Seccion_ID = n.Seccion_ID
            WHERE s.Periodo = :period
            GROUP BY c.Codigo_Curso, c.Nombre_Curso, p.Nombres
        ');
        $stmt->execute(['period' => $period]);
        return $stmt->fetchAll();
    }

    // Get historical approval percentage by professor for a course
    public function getHistoricalApprovalByProfessor($courseCode)
    {
        $stmt = $this->pdo->prepare('
            SELECT p.Nombres AS Profesor,
                   (SUM(CASE WHEN n.Resultado = "Aprobatorio" THEN 1 ELSE 0 END) / COUNT(n.Resultado)) * 100 AS Porcentaje_Aprobacion
            FROM curso c
            INNER JOIN seccion s ON c.Codigo_Curso = s.Codigo_Curso
            INNER JOIN dicta d ON s.Seccion_ID = d.Seccion_ID
            INNER JOIN academico a ON d.RUN = a.RUN
            INNER JOIN persona p ON a.RUN = p.RUN
            INNER JOIN nota n ON s.Seccion_ID = n.Seccion_ID
            WHERE c.Codigo_Curso = :courseCode
            GROUP BY p.Nombres
        ');
        $stmt->execute(['courseCode' => $courseCode]);
        return $stmt->fetchAll();
    }

    // Additional methods as needed
}
