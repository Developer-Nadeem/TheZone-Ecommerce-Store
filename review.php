<?php
session_start();

if (isset($_POST['submitted'])) {
  if (empty($_POST['description'])) {
    echo 'Please write a review';
    exit;
  }
}
