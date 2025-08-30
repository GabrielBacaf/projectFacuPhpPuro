
    <div class="row">
        <div>
            <label for="titulo">Título</label>
            <input required type="text" name="titulo" id="titulo" value="<?= htmlspecialchars($book['titulo'] ?? '') ?>">
        </div>
        <div>
            <label for="autor">Autor</label>
            <input required type="text" name="autor" id="autor" value="<?= htmlspecialchars($book['autor'] ?? '') ?>">
        </div>
        <div>
            <label for="editora">Editora</label>
            <input required type="text" name="editora" id="editora" value="<?= htmlspecialchars($book['editora'] ?? '') ?>">
        </div>
        <div>
            <label for="ano_publicacao">Ano de Publicação</label>
            <input required type="number" name="ano_publicacao" id="ano_publicacao" value="<?= htmlspecialchars($book['ano_publicacao'] ?? '') ?>">
        </div>
        <div>
            <label for="genero">Gênero</label>
            <input required type="text" name="genero" id="genero" value="<?= htmlspecialchars($book['genero'] ?? '') ?>">
        </div>
    </div>