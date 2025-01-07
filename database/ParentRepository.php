<?php
class ParentRepository extends BaseRepository
{
  public function __construct()
  {
    parent::__construct('Parents');  // Le nom de la table est 'Parents'
  }
}
