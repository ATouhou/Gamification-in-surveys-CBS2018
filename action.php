<?php session_start();

header('Access-Control-Allow-Origin: *');
require 'includes/MysqliDb.php';
require 'includes/inc_credentials.php';


//var_dump($_POST);


$json = json_decode($_POST["data"]);

//var_dump($json);

//db: adamtouh_gamification
//adamtouh_gamify
//CBS2018


$variation = $_POST['variation'];
$endtime = $db->now();



if($variation == 1){
$endlabel = "gamified_finished";
$prepend_for_column = "g_";
}elseif($variation == 2){
$endlabel = "standard_finished";
$prepend_for_column = "s_";
}


$data = Array (
    $endlabel => $endtime,
    $prepend_for_column . 'q1' => $json->q1,
    $prepend_for_column . 'q2' => $json->q2,
    $prepend_for_column . 'q3' => $json->q3,
    $prepend_for_column . 'q4' => $json->q4,
    $prepend_for_column . 'q5' => $json->q5,
    $prepend_for_column . 'q6' => $json->q6,
    $prepend_for_column . 'q7' => $json->q7,
    $prepend_for_column . 'q8' => $json->q8,
    $prepend_for_column . 'q9' => $json->q9,
    $prepend_for_column . 'q10' => $json->q10,
    $prepend_for_column . 'q11' => $json->q11,
    $prepend_for_column . 'q12' => $json->q12,
    $prepend_for_column . 'q13' => $json->q13,
    $prepend_for_column . 'q14' => $json->q14,
    $prepend_for_column . 'q15' => $json->q15,
    $prepend_for_column . 'q16' => $json->q16,
    $prepend_for_column . 'q17' => $json->q17
);

$db->where ('uuid', $_SESSION['uuid']);
if ($db->update ('entries', $data)){
   // echo $db->count . ' records were updated';

    $db->where ('uuid', $_SESSION['uuid']);
    $entry = $db->getOne ("entries");
    if($variation != $entry['firstroute']){
        //they finished
        echo "https://touhou.dk/gamification/thank-you.html";
    }else{
        //they only completed part 1
        if($variation == 1){
            echo "https://touhou.dk/gamification/g/survey-standard.html";
            $start_label = 'standard';
        }elseif($variation == 2){
            $start_label = 'gamified';
            echo "https://touhou.dk/gamification/g/survey-gamified.html";
        }

    $data = Array (
        $start_label . '_start' => $endtime
    );

    $db->where ('uuid', $_SESSION['uuid']);
    if ($db->update ('entries', $data)){
    }

    }


}else{
    echo 'update failed: ' . $db->getLastError();
}
