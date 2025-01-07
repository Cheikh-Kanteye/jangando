<?php
require_once 'BaseRepository.php';

class ExamRepository extends BaseRepository
{
  public function __construct()
  {
    parent::__construct('Exams');
  }
}
