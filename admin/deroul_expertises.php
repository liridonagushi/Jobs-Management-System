<?php
//Include database configuration file
include('assets/include/functions.php');

if(isset($_POST["id_cat_expertise"]) && !empty($_POST["id_cat_expertise"])){
    
    //Get all state data
    $query = $dbj->query("SELECT id_expertise, id_category, ".$_SESSION['jbms_front']['lang_code']."_expertise_area AS expertise_area FROM expertises WHERE id_category = '".$_POST['id_cat_expertise']."' AND active = 1 ORDER BY id_expertise");

    //Count total number of rows
    $rowCount = $query->rowCount();
    
    //Display states list
    if($rowCount > 0){
        echo '<option value="">Select expertise</option>';
        while($row_exp=$query->fetch(PDO::FETCH_ASSOC)){
            echo '<option value="'.$row_exp['id_expertise'].'">'.$row_exp['expertise_area'].'</option>';
        }
    }else{
        echo '<option value="">No expertises</option>';
    }
}
?>