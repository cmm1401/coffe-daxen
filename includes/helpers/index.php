<?php
  function sanatizeHtml($dataToEvaluate) {
    $allowedTypes = ["string", "array"];
    if (in_array(gettype($dataToEvaluate), $allowedTypes)) {
      throw new Exception('');
      return;
    } 
    if (gettype($dataToEvaluate) === "string") {
      return htmlspecialchars($dataToEvaluate);
    } else if (gettype($dataToEvaluate) === "array") { 
      $data = "";
      foreach ($dataToEvaluate as $value) {
        $data .= $value;
      }
      return htmlspecialchars($data);
    }

  }
  
  function showError() {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
  }

  function debuguear($value, $var = "v"){
    switch ($var) {
        case "jn":
            echo json_encode($value);
            break;
        case "pr":
            echo "<pre>";
            print_r($value);
            echo "</pre>";
            break;
        case "v":
        default:
            echo "<pre>";
            var_dump($value);
            echo "</pre>";
            break;
    }
    exit;
}