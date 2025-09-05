   <?php
    require_once __DIR__ . '/../../services/autoraService.php';
    $autoras = listAutoras();
    ?>

   <div class="row">
       <div>
           <label for="titulo">Título</label>
           <input autocomplete="off" autocomplete="off" type="text" name="titulo" id="titulo" value="<?= htmlspecialchars($book['titulo'] ?? '') ?>">
           <?php if (!empty($errors['titulo'])): ?>
               <span style="color:red"><?= htmlspecialchars($errors['titulo']) ?></span>
           <?php endif; ?>
       </div>

       <div>
           <label for="autor">Autor</label>

           <select name="autor_id" id="autor_id">
               <option value="">Selecione a autora</option>
               <?php
                foreach ($autoras as $autora) : ?>
                   <option value="<?= $autora['id'] ?>"
                       <?= isset($book['autora_id']) && $book['autora_id'] == $autora['id'] ? 'selected' : '' ?>>
                       <?= htmlspecialchars($autora['nome']) ?>
                   </option>
               <?php endforeach; ?>
           </select>
           <?php if (!empty($errors['autor_id'])): ?>
               <span style="color:red"><?= htmlspecialchars($errors['autor_id']) ?></span>
           <?php endif; ?>

       </div>

       <div>
           <label for="editora">Editora</label>
           <input autocomplete="off" type="text" name="editora" id="editora" value="<?= htmlspecialchars($book['editora'] ?? '') ?>">
           <?php if (!empty($errors['editora'])): ?>
               <span style="color:red"><?= htmlspecialchars($errors['editora']) ?></span>
           <?php endif; ?>
       </div>

       <div>
           <label for="ano_publicacao">Ano de Publicação</label>
           <input autocomplete="off" type="number" name="ano_publicacao" id="ano_publicacao" value="<?= htmlspecialchars($book['ano_publicacao'] ?? '') ?>">
           <?php if (!empty($errors['ano_publicacao'])): ?>
               <span style="color:red"><?= htmlspecialchars($errors['ano_publicacao']) ?></span>
           <?php endif; ?>
       </div>

       <div>
           <label for="genero">Gênero</label>
           <input autocomplete="off" type="text" name="genero" id="genero" value="<?= htmlspecialchars($book['genero'] ?? '') ?>">
           <?php if (!empty($errors['genero'])): ?>
               <span style="color:red"><?= htmlspecialchars($errors['genero']) ?></span>
           <?php endif; ?>
       </div>

       <div>
           <label for="imagem">Imagem do Livro</label>
           <input autocomplete="off" class="file" type="file" name="imagem" accept="image/*">
           <?php if (!empty($errors['imagem'])): ?>
               <span style="color:red"><?= htmlspecialchars($errors['imagem']) ?></span>
           <?php endif; ?>
       </div>

       <div>
           <label for="resumo">Resumo do Livro</label>
           <textarea class="resumo" name="resumo" rows="7"><?= htmlspecialchars($book['resumo'] ?? '') ?></textarea>
           <?php if (!empty($errors['resumo'])): ?>
               <span style="color:red"><?= htmlspecialchars($errors['resumo']) ?></span>
           <?php endif; ?>
       </div>
   </div>