<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      margin: 0;
      padding: 0;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #e9ecef;
    }

    .card {
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
      padding: 40px 30px;
      width: 100%;
      max-width: 400px;
      border: 1px solid #dee2e6;
    }

    .card h2 {
      margin-bottom: 30px;
      text-align: center;
      color: #343a40;
    }

    .card input[type="email"],
    .card input[type="password"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border: 1px solid #ced4da;
      border-radius: 8px;
      font-size: 15px;
      background-color: #f8f9fa;
    }

    .card button {
      width: 100%;
      padding: 12px;
      background-color: #0d6efd;
      color: #fff;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      transition: background-color 0.3s;
    }

    .card button:hover {
      background-color: #084298;
    }

    .error {
      color: red;
      text-align: center;
      margin-bottom: 15px;
    }
  </style>
</head>
<body>

  <div class="card">
    <h2>Login</h2>

    <?php if($this->session->flashdata('error')): ?>
      <div class="error"><?= $this->session->flashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('auth/login') ?>" method="post">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Masuk</button>
    </form>
  </div>

</body>
</html>
