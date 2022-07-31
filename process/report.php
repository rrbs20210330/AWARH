<?php
include('../config/reports.php');
    if(isset($_GET) && isset($_GET['typeOp'])){
        $operacion = intval($_GET['typeOp']);
        if(isset($_GET['id'])){
            $id = intval($_GET['id']);
            switch ($operacion) {
                case 1:
                    $pdf = new Report();
                    $pdf->GenerateReportAnnouncement($id);
                    break;
                case 2:
                    $pdf = new Report();
                    $pdf->GenerateReportEmployee($id);
                    break;
                case 3:
                    $pdf = new Report();
                    $pdf->GenerateReportCandidate($id);
                    break;
                default:
                    exit;
                    break;
            }
        }else{
            switch ($operacion) {
                case 1:
                    $pdf = new Report();
                    $pdf->GenerateReportAllAnnouncements();
                    break;
                case 2:
                    $pdf = new Report();
                    $pdf->GenerateReportAllEmployees();
                    break;
                case 3:
                    $pdf = new Report();
                    $pdf->GenerateReportAllCandidates();
                    break;
                default:
                    exit;
                    break;
            }
        }
    }
?>