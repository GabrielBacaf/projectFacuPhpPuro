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
        <label for="premios">Prêmios</label>
        <input type="text" name="premios" id="premios" value="<?= htmlspecialchars($autora['premios'] ?? '') ?>">
    </div>

    <div>
        <label for="imagem">Imagem do Autora</label>
        <input class="file" type="file" name="imagem" accept="image/*">
        <?php if (!empty($errors['imagem'])): ?>
            <span style="color:red"><?= htmlspecialchars($errors['imagem']) ?></span>
        <?php endif; ?>
    </div>
    <div>
        
    </div>

    <div>
        <label for="descricao">Descrição/Biografia</label>
        <textarea class="resumo" name="descricao" rows="7"><?= htmlspecialchars($book['descricao'] ?? '') ?></textarea>
        <?php if (!empty($errors['descricao'])): ?>
            <span style="color:red"><?= htmlspecialchars($errors['descricao']) ?></span>
        <?php endif; ?>
    </div>

</div>