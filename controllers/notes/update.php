<?php

use Core\Validator;
use Models\Notes;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];

    if (!Validator::string($_POST['body'], 1, 1000)) {
        $errors['body'] = 'The body field is required and must be less than 1000 characters.';
    }

    $id = Validator::param($_POST['id'] ?? null);

    if (empty($errors)) {
        $data = [
            'body' => $_POST['body']
        ];
        $table = new Notes();

        if ($table->find($id)) {
            $table->update($id, $data);
            header("Location: /note?id={$id}");
            die();
        }
    } else {
        return view('notes.edit', ['title' => 'Edit Note', 'errors' => $errors]);
    }

    header('Location: /notes');
    die();
}