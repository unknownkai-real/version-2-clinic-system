<!doctype html><html><head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light d-flex align-items-center" style="min-height:100vh;">
<div class="container"><div class="row justify-content-center"><div class="col-md-4">
<div class="card shadow-sm"><div class="card-body">
<h4 class="mb-3 text-center">Clinic Login</h4>
<?php if (!empty($_SESSION['flash'])): $f=$_SESSION['flash']; unset($_SESSION['flash']); ?><div class="alert alert-<?= $f['type'] ?>"><?= htmlspecialchars($f['message']) ?></div><?php endif; ?>
<form method="post">
  <div class="mb-3"><label class="form-label">Username</label><input class="form-control" name="username" required></div>
  <div class="mb-3"><label class="form-label">Password</label><input type="password" class="form-control" name="password" required></div>
  <button class="btn btn-primary w-100">Sign In</button>
</form></div></div></div></div></div>
</body></html>
