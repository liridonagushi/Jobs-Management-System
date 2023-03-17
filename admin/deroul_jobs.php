<?php
//Include database configuration file
include('assets/include/functions.php');

if(isset($_POST["id_company"]) && !empty($_POST["id_company"])){
    
//Get all state data
$query = $dbj->query('SELECT DISTINCT job_offers.id_job, job_offers.job_title, companies.id_company FROM job_offers LEFT JOIN companies ON companies.id_company=job_offers.id_company WHERE companies.active="1" AND companies.id_company="'.$_POST['id_company'].'" ORDER BY job_offers.job_title');

    //Count total number of rows
    $rowCount = $query->rowCount();
    
    //Display states list
    if($rowCount > 0){
        echo '<option value="">Select job offer</option>';
        while($row_job=$query->fetch(PDO::FETCH_ASSOC)){ 
            echo '<option value="'.$row_job['id_job'].'">'.$row_job['job_title'].'</option>';
        }
    }else{
        echo '<option value="">No results</option>';
    }
}
?>