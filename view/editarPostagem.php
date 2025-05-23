<?php
session_start();
include '../model/categoria.php';
include '../model/postagem.php';

$id_postagem=$_GET['id_postagem'];
$categoria= new categoria('','','');

$categorias= $categoria->listarCategorias();

$postagem= new postagem ('','','','','','');
$dadosPostagem= $postagem->BuscarUnicaPostagem($id_postagem);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Adicionar Post - Social Network</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        background-color: #f8f9fa;
      }
      .form-card {
        max-width: 600px;
        margin: 60px auto;
        border: none;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      }
      .form-control:focus {
        border-color: #0d6efd;
        box-shadow: none;
      }
      #preview-img {
        max-width: 100%;
        max-height: 300px;
        margin-top: 10px;
        display: none;
      }
    </style>
  </head>
  <body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm">
      <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="index.php">Social Network</a>
      </div>
    </nav>

          <?php
      if (isset($_SESSION['msg'])) {
          echo '<div class="alert alert-success">' . $_SESSION['msg'] . '</div>';
          unset($_SESSION['msg']);
      }
      ?>


    <!-- Formulário de Post -->
    <div class="card form-card">
      <div class="card-body">
        <h4 class="card-title text-center mb-4">Editar Post</h4>
        <form action="../controller/postagem/editarPostagem.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_postagem" value="<?php echo $dadosPostagem['id_postagem']; ?>">

        <div class="mb-3">
            <label for="categoria" class="form-label">Categorias</label>
            <select class="form-select" id="categoria" name="categoria" required>
              <option name="categoria" >Selecione uma categoria</option>
              <?php foreach($categorias as $c): ?>
                <option value="<?php echo $c['id_categoria']; ?>" 
                    <?php echo ($dadosPostagem['id_categoria'] == $c['id_categoria']) ? 'selected' : ''; ?>>
                    <?php echo $c['nome']; ?>
                </option>
                <?php endforeach; ?>
            </select>
  
        </div>

          <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $dadosPostagem['titulo'] ?>" maxlength="150" required>
          </div>
          <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="4" placeholder="Digite a descrição do post" required><?php echo $dadosPostagem['descricao']; ?></textarea>
            </div>
          <div class="mb-3">
            <label for="imagem" class="form-label"> Substituir Imagem (opcional)</label>
            <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*">

            <?php if (!empty($dadosPostagem['imagem'])): ?>
            <label for="">imagem atual:</label>
            <img src="../uploads/<?php echo $dadosPostagem['imagem']; ?>" alt="Imagem atual" style="max-width: 100%; max-height: 300px; margin-bottom: 10px;">
           <input type="hidden" name="imagem_atual" value="<?php echo $dadosPostagem['imagem']; ?>">

            <?php endif; ?>
            <!-- Preview da imagem -->
            <img id="preview-img" alt="Preview da Imagem">
          </div>
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Salvar Edição</button>
          </div>
        </form>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript para Preview -->
    <script>
      const inputImagem = document.getElementById('imagem');
      const previewImg = document.getElementById('preview-img');

      inputImagem.addEventListener('change', function() {
        const file = this.files[0];

        if (file) {
          const reader = new FileReader();

          reader.addEventListener('load', function() {
            previewImg.setAttribute('src', this.result);
            previewImg.style.display = 'block';
          });

          reader.readAsDataURL(file);
        } else {
          previewImg.setAttribute('src', '');
          previewImg.style.display = 'none';
        }
      });
    </script>
  </body>
</html>
