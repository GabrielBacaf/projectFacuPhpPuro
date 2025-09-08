
<?php


function validAutora(array $data, ?array $file): array
{
    $errors = [];

    //  1. Validação do campo "Nome" ---
    if (empty(trim($data['nome']))) {
        $errors['nome'] = 'O campo "Nome" é obrigatório e não pode ficar em branco.';
    } elseif (strlen($data['nome']) > 255) {
        $errors['nome'] = 'O nome não pode ter mais de 255 caracteres.';
    }

    //  2. Validação do campo "Idade" ---
    if (!empty($data['idade'])) {
        if (!filter_var($data['idade'], FILTER_VALIDATE_INT)) {
            $errors['idade'] = 'O campo "Idade" deve ser um número inteiro válido.';
        } elseif ((int)$data['idade'] < 0 || (int)$data['idade'] > 120) {
            $errors['idade'] = 'Por favor, insira uma idade válida (entre 0 e 120).';
        }
    }
    
    //  3. Validação de campos de texto opcionais ---
    if (isset($data['nacionalidade']) && strlen($data['nacionalidade']) > 255) {
        $errors['nacionalidade'] = 'A nacionalidade não pode ter mais de 255 caracteres.';
    }
    
    if (isset($data['premios']) && strlen($data['premios']) > 1000) {
        $errors['premios'] = 'O campo de prêmios não pode ter mais de 1000 caracteres.';
    }

    // 4. Validação do campo "Descrição" ---
    if (isset($data['descricao']) && strlen($data['descricao']) > 5000) {
        $errors['descricao'] = 'A descrição/biografia não pode exceder 5000 caracteres.';
    }
    
    //  5. Validação do Upload de Imagem ---
    if ($file && $file['error'] !== UPLOAD_ERR_NO_FILE) {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $errors['imagem'] = 'Ocorreu um erro durante o upload da imagem. Tente novamente.';
        } else {
            $maxFileSize = 2 * 1024 * 1024; // 2 Megabytes
            if ($file['size'] > $maxFileSize) {
                $errors['imagem'] = 'O arquivo de imagem é muito grande. O tamanho máximo é de 2MB.';
            }

            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            $fileMimeType = mime_content_type($file['tmp_name']);
            if (!in_array($fileMimeType, $allowedTypes)) {
                $errors['imagem'] = 'Formato de arquivo inválido. Por favor, envie uma imagem (JPEG, PNG, GIF ou WEBP).';
            }
        }
    }

    return $errors;

}