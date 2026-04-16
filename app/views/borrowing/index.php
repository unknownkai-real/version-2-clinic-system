<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="card form-card mb-3"><div class="card-body"><h5>Borrowing of Equipment</h5>
<form method="post" class="row g-2"><input type="hidden" name="action" value="create">
<div class="col-md-2"><input class="form-control" name="borrower_name" placeholder="Borrower Name" required></div>
<div class="col-md-2"><select class="form-select" name="inventory_id"><?php foreach($items as $i): ?><option value="<?= $i['id'] ?>"><?= htmlspecialchars($i['item_name']) ?></option><?php endforeach; ?></select></div>
<div class="col-md-2"><input type="date" class="form-control" name="date_borrowed" required></div>
<div class="col-md-2"><input type="date" class="form-control" name="date_returned"></div>
<div class="col-md-2"><input class="form-control" name="item_condition" placeholder="Condition"></div>
<div class="col-md-2"><input class="form-control" name="staff_name" placeholder="Staff" required></div>
<div class="col-12"><button class="btn btn-primary">Save Log</button></div></form></div></div>
<div class="card"><div class="card-body"><div class="d-flex justify-content-between mb-2"><h5>Borrowing Logs</h5><form><input type="hidden" name="route" value="borrowing"><input class="form-control" name="search" value="<?= htmlspecialchars($search) ?>"></form></div>
<table class="table"><thead><tr><th>Borrower</th><th>Item</th><th>Borrowed</th><th>Returned</th><th>Condition</th><th>Actions</th></tr></thead><tbody>
<?php foreach($logs as $b): ?><tr data-highlight><td><?= htmlspecialchars($b['borrower_name']) ?></td><td><?= htmlspecialchars($b['item_name']) ?></td><td><?= htmlspecialchars($b['date_borrowed']) ?></td><td><?= htmlspecialchars($b['date_returned']) ?></td><td><?= htmlspecialchars($b['item_condition']) ?></td><td>
<button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editBor<?= $b['id'] ?>">Edit</button>
<form method="post" class="d-inline" onsubmit="return confirm('Delete log?')"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $b['id'] ?>"><button class="btn btn-danger btn-sm">Delete</button></form></td></tr>
<div class="modal fade" id="editBor<?= $b['id'] ?>"><div class="modal-dialog"><div class="modal-content"><form method="post"><div class="modal-header"><h6>Edit Borrowing</h6></div><div class="modal-body"><input type="hidden" name="action" value="update"><input type="hidden" name="id" value="<?= $b['id'] ?>"><input class="form-control mb-2" name="borrower_name" value="<?= htmlspecialchars($b['borrower_name']) ?>"><input class="form-control mb-2" name="inventory_id" value="<?= $b['inventory_id'] ?>"><input type="date" class="form-control mb-2" name="date_borrowed" value="<?= $b['date_borrowed'] ?>"><input type="date" class="form-control mb-2" name="date_returned" value="<?= $b['date_returned'] ?>"><input class="form-control mb-2" name="item_condition" value="<?= htmlspecialchars($b['item_condition']) ?>"><input class="form-control" name="staff_name" value="<?= htmlspecialchars($b['staff_name']) ?>"></div><div class="modal-footer"><button class="btn btn-primary">Save</button></div></form></div></div></div>
<?php endforeach; ?></tbody></table></div></div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
