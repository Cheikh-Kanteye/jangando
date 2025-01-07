<?php
require_once 'BaseRepository.php';

class EventRepository extends BaseRepository
{
  public function __construct()
  {
    parent::__construct('Events');
  }
}
