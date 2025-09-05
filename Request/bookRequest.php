<?php

function validBook(array $data): array
{
    $errors = [];

    foreach ($data as $key => $value) {
        $data[$key] = trim($value);
    }

    foreach ($data as $key => $value) {
        if ($key === 'autor_id') {
            $fieldLabel = 'autor';
        } elseif ($key === 'ano_publicacao') {
            $fieldLabel = 'ano de publicação';
        } else {
            $fieldLabel = $key;
        }



        $errors[$key] = empty($value)
            ? "O campo {$fieldLabel} não pode ser vazio."
            : true;

        if ($errors[$key] !== true) continue;


        $errors[$key] = in_array($key, ['titulo', 'editora', 'genero']) && is_numeric($value)
            ? "O campo {$key} não pode ser numérico."
            : true;

        if ($errors[$key] !== true) continue;


        $errors[$key] = ($key === 'ano_publicacao' && !is_numeric($value))
            ? "O campo ano de publicação deve ser numérico."
            : true;

        if ($errors[$key] !== true) continue;


        $errors[$key] = ($key === 'autora_id' && (!is_numeric($value)))
            ?  "O campo Autor deve ser um número válido."
            : true;

        if ($errors[$key] !== true) continue;


        if ($key === 'imagem' && is_array($value)) {
            if ($value['error'] !== UPLOAD_ERR_OK) {
                $errors[$key] = "Erro no upload da imagem.";
            } else {
                $ext = strtolower(pathinfo($value['name'], PATHINFO_EXTENSION));
                $permitidas = ['jpg', 'jpeg', 'png', 'gif'];
                $errors[$key] = !in_array($ext, $permitidas)
                    ? "Formato inválido. Use JPG, JPEG, PNG ou GIF."
                    : true;
            }
        }
    }

    return array_filter($errors, fn($e) => $e !== true);
}
