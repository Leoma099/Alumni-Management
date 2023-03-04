<?php

  // Retrieve data from database

  require_once realpath("../../include/loadclass.php");

  if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }

  $search = new Classes\Controller\SearchController();

  $result = $search->getCategoryJobList($_POST['search_data']);

  if($result->rowCount() > 0){
    while($row = $result->fetch()){
      $data[] = array(
        'name' => $row['name'],
        'category' => $row['category'],
        'title' => $row['title'],
        'salary' => $row['salary'],
        'type' => $row['type'],
        'action' => '

        <a onclick=displayData('.$row["job_id"].') class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewvacancy"><i class="fas fa-pen-to-square"></i></a>
        
        <a onclick=removeRow('.$row["job_id"].')  class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>',
      );
    }
  }else{
    $data[] = array(
      'name' => "",
      'category' => "",
      'title' => "",
      'salary' => "",
      'type' => "",
      'action' => '',
    );
  }

  // Encode the data in JSON format
  echo json_encode($data);

?>