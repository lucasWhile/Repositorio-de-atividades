<?php session_start(); ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Adicionar Categoria - Social Network</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style> 
      body {
        background-color: #f8f9fa;
      }
      .form-card { 
        max-width: 400px;
        margin: 60px auto;
        border: none;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
       }
      .form-control:focus {
        border-color: #0d6efd;
        box-shadow: none;
      }
    </style>
  </head>
  <body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm">
      <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">Social Network</a>
      </div>
    </nav>

    <!-- Formulário de Categoria -->
    <div class="card form-card">
      <div class="card-body">
        <h4 class="card-title text-center mb-4">Adicionar Categoria</h4>
        <form method="post" action="../controller/categoria/cadastrarCategoria.php">
          <div class="mb-3">
            <label for="categoria" class="form-label">Nome da Categoria</label>
            <input type="text" class="form-control" name="nome_categoria" id="categoria" placeholder="Digite o nome da categoria">
          </div>
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Salvar Categoria</button>
          </div>
        </form>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
