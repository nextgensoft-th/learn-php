<?php

use Core\Validator;
use Models\Notes;

$model = new Notes();

$id = Validator::param($_GET['id'] ?? null);
$note = $model->find($id);


auth(!isset($note['user_id']) || $note['user_id'] !== 3);


view('notes.edit',['title' => 'Edit Note', 'note' => $note]);