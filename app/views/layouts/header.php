<?php $config = require __DIR__ . '/../../config/config.php'; $route = $_GET['route'] ?? 'dashboard'; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($config['app']['name']) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <aside class="col-md-2 sidebar p-3">
      <h5 class="text-white">Clinic System</h5>
      <?php foreach ([
        'dashboard'=>'Dashboard','students'=>'Students','employees'=>'Employees','inventory'=>'Inventory',
        'visits'=>'Visits','consultations'=>'Consultations','borrowing'=>'Borrowing','first-aid'=>'First Aid'
      ] as $key=>$label): ?>
        <a class="<?= $route===$key ? 'active':'' ?>" href="index.php?route=<?= $key ?>"><?= $label ?></a>
      <?php endforeach; ?>
      <hr><a href="index.php?route=logout">Logout</a>
    </aside>
    <main class="col-md-10 main-content">
      <?php if (!empty($_SESSION['flash'])): $f = $_SESSION['flash']; unset($_SESSION['flash']); ?>
        <div class="alert alert-<?= $f['type'] ?>"><?= htmlspecialchars($f['message']) ?></div>
      <?php endif; ?>
