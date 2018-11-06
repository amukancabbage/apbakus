<?php
    ob_start();
    session_start(); 
    include_once "../library/connection.php";
    include_once "../library/library.php";
    include_once "../library/library.pdo.php";
    include_once "../library/library.generator.php";
    include_once "../library/library.gentella.php";

    $report=$_GET['report'];

    if($report=='ABK')
        include('abk.php');
    $content = ob_get_clean();
 
    // conversion HTML => PDF
    require_once('../vendors/html2pdf/html2pdf.class.php');
    try
    {
    $html2pdf = new HTML2PDF('L','F4','en', false, 'ISO-8859-15',array(15, 10, 10, 10));
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($report.'.pdf');
    }
    catch(HTML2PDF_exception $e) { echo $e; }
    
?>