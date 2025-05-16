<?php
session_start();
include '../model/categoria.php';
include '../model/postagem.php';

$id = $_GET['id'];
$categoria = new categoria('', '', '');

$categorias = $categoria->BuscarUnicaCategoria($id);
?>

<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Editar Categoria - Social Network</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
      body {
        background-color: #f8f9fa;
      }
      .form-card {
        max-width: 500px;
        margin: 60px auto;
        border: none;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        border-radius: 0.5rem;
      }
      .btn-group {
        display: flex;
        justify-content: space-between;
        margin-top: 1.5rem;
      }
      .alert {
        max-width: 500px;
        margin: 20px auto 0;
        border-radius: 0.5rem;
      }
    </style>
  </head>
  <body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm">
      <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">Social Network</a>
      </div>
    </nav>

    <?php if (isset($_SESSION['msg'])): ?>
      <div class="alert alert-success text-center" role="alert">
        <?php 
          echo $_SESSION['msg']; 
          unset($_SESSION['msg']);
        ?>
      </div>
    <?php endif; ?>

    <main>
      <div class="card form-card">
        <div class="card-body">
          <h4 class="card-title text-center mb-4">Editar Categoria</h4>

          <form action="../controller/categoria/editarCategoria.php" method="post" novalidate>
            <div class="mb-3">
              <label for="nome" class="form-label">Nome da Categoria:</label>
              <input 
                type="text" 
                class="form-control" 
                id="nome" 
                name="nome" 
                value="<?php echo htmlspecialchars($categorias['nome']); ?>" 
                required
                autofocus
              >
            </div>

            <input type="hidden" name="id_categoria" value="<?php echo (int)$categorias['id_categoria']; ?>">

            <div class="btn-group">
              <button type="submit" class="btn btn-primary">Aplicar Modificação</button>
              <a href="listar_categoria.php" class="btn btn-outline-secondary">Voltar</a>
            </div>
          </form>
        </div>
      </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
