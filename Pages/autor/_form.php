<div class="row">
    <div>
        <label for="nome">Nome</label>
        <input required type="text" name="nome" id="nome" value="<?= htmlspecialchars($autora['nome'] ?? '') ?>">
    </div>
    <div>
        <label for="idade">Idade</label>
        <input type="number" name="idade" id="idade" value="<?= htmlspecialchars($autora['idade'] ?? '') ?>">
    </div>
    <div>
        <label for="nacionalidade">Nacionalidade</label>
        <input type="text" name="nacionalidade" id="nacionalidade" value="<?= htmlspecialchars($autora['nacionalidade'] ?? '') ?>">
    </div>
    <div>
        <label for="descricao">Descrição/Biografia</label>
        <textarea name="descricao" id="descricao"><?= htmlspecialchars($autora['descricao'] ?? '') ?></textarea>
    </div>
    <div>
        <label for="premios">Prêmios</label>
        <textarea name="premios" id="premios"><?= htmlspecialchars($autora['premios'] ?? '') ?></textarea>
    </div>
    <!-- Novo campo para imagem -->
    <div>
        <label for="imagem">Imagem da Autora</label>
        <input type="file" name="imagem" id="imagem" accept="image/*">
    </div>
    <div>
    <label for="autor_id">Autora</label>
    
</div>
</div>
