<?php
require_once('../database.php');

global $DbOfficeEnumLabels;
class OfficeEnum
{
  const REGISTRAR = 'REGISTRAR';
  const ACCOUNTING = 'ACCOUNTING';
  const ASSETS = 'ASSETS';
  const CLINIC = 'CLINIC';
  const ITRO = 'ITRO';
  const ACADEMICS = 'ACADEMICS';
}

$DbOfficeEnumLabels = [
  OfficeEnum::REGISTRAR => 'registrar',
  OfficeEnum::ACCOUNTING => 'accounting',
  OfficeEnum::ASSETS => 'assets',
  OfficeEnum::CLINIC => '',
  OfficeEnum::ITRO => '',
  OfficeEnum::ACADEMICS => 'academics'
];

if ($_POST['action'] == 'endorse') {
  $queueHandler = new QueueHandler($conn);
  $queueHandler->handleAction($_POST, 'endorse');
}

if ($_POST['action'] == 'transaction_complete') {
  $queueHandler = new QueueHandler($conn);
  $queueHandler->handleAction($_POST, 'transaction_complete');
}

class QueueHandler
{
  private $conn;

  public function __construct($conn)
  {
    $this->conn = $conn;
  }

  private function endorseQueue($post_data)
  {
    try {
      global $DbOfficeEnumLabels;
      $CURRENT_OFFICE = 'ADMISSION';

      $queue_number = $post_data['queue_number'];
      $office = $post_data['office'];
      $remarks = $post_data['remarks'];
      $student_id = $post_data['student_id'];
      $time_stamp = $post_data['time_stamp'];
      $endorsed_from = $CURRENT_OFFICE;

      $insertIntoOfficeQuery = "INSERT INTO $DbOfficeEnumLabels[$office] (queue_number, student_id, remarks, timestamp, endorsed_from) VALUES ('$queue_number', '$student_id', '$remarks', '$time_stamp', '$endorsed_from')";
      $result = $this->conn->query($insertIntoOfficeQuery);

      if ($result) {
        return 'success';
      } else {
        return 'failed';
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  private function setQueueStatus($post_data)
  {
    try {
      $STATUS_COMPLETE = 1;

      $queue_number = $post_data['queue_number'];

      $admissionQuery = "UPDATE queue SET status = '$STATUS_COMPLETE' WHERE queue_number = '$queue_number'";

      $this->conn->query($admissionQuery);

      $queueQuery = "UPDATE admission SET status = '$STATUS_COMPLETE' WHERE queue_number = '$queue_number'";

      $result = $this->conn->query($queueQuery);

      return $result;
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  private function insertQueueToLog($post_data)
  {
    try {
      $student_id = $post_data['student_id'];
      $queue_number = $post_data['queue_number'];
      $office = $post_data['office'];
      $remarks = $post_data['remarks'];
      $time_stamp = $post_data['time_stamp'];
      $current_date_time = date("Y-m-d H:i:s");

      $sql = "INSERT INTO admission_logs (student_id, queue_number, office, remarks, timestamp, timeout) VALUES ('$student_id', '$queue_number', '$office', '$remarks', '$time_stamp', '$current_date_time')";

      return $this->conn->query($sql);
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  public function handleAction($post_data, $queue_action)
  {
    $response = null;

    if ($queue_action == 'endorse') {
      $response = $this->endorseQueue($post_data);
      $response = $this->setQueueStatus($post_data);
    } else if ($queue_action == 'transaction_complete') {
      $response = $this->setQueueStatus($post_data);
    }

    if ($response) {
      $this->insertQueueToLog($post_data);
      echo 'success';
    } else {
      echo 'failed';
    }
  }
}
