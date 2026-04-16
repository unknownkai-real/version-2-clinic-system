<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="card form-card mb-3"><div class="card-body"><h5>Add Inventory Item</h5>
<form method="post" class="row g-2"><input type="hidden" name="action" value="create">
<div class="col-md-3"><input class="form-control" name="item_name" placeholder="Item Name" required></div>
<div class="col-md-2"><input class="form-control" name="category" placeholder="Category" required></div>
<div class="col-md-1"><input type="number" class="form-control" name="quantity" min="0" required></div>
<div class="col-md-2"><input type="date" class="form-control" name="expiration_date"></div>
<div class="col-md-2"><input class="form-control" name="batch_no" placeholder="Batch No"></div>
<div class="col-md-2"><input class="form-control" name="notes" placeholder="Notes"></div>
<div class="col-md-2"><div class="form-check mt-2"><input class="form-check-input" type="checkbox" name="is_damaged" id="damaged"><label class="form-check-label" for="damaged">Damaged</label></div></div>
<div class="col-12"><button class="btn btn-primary">Add Item</button></div></form></div></div>
<div class="card"><div class="card-body"><div class="d-flex justify-content-between mb-2"><h5>Inventory List</h5><form><input type="hidden" name="route" value="inventory"><input class="form-control" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search..."></form></div>
<table class="table"><thead><tr><th>Item</th><th>Qty</th><th>Expiration</th><th>Damaged</th><th>Actions</th></tr></thead><tbody>
<?php foreach($items as $i): ?><tr data-highlight><td><?= htmlspecialchars($i['item_name']) ?></td><td><?= $i['quantity'] ?></td><td><?= htmlspecialchars($i['expiration_date']) ?></td><td><?= $i['is_damaged']?'Yes':'No' ?></td><td>
<button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editInv<?= $i['id'] ?>">Edit</button>
<form method="post" class="d-inline" onsubmit="return confirm('Delete item?')"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $i['id'] ?>"><button class="btn btn-danger btn-sm">Delete</button></form></td></tr>
<div class="modal fade" id="editInv<?= $i['id'] ?>"><div class="modal-dialog"><div class="modal-content"><form method="post"><div class="modal-header"><h6>Edit Item</h6></div><div class="modal-body row g-2"><input type="hidden" name="action" value="update"><input type="hidden" name="id" value="<?= $i['id'] ?>">
<div class="col-6"><input class="form-control" name="item_name" value="<?= htmlspecialchars($i['item_name']) ?>"></div><div class="col-6"><input class="form-control" name="category" value="<?= htmlspecialchars($i['category']) ?>"></div>
<div class="col-6"><input type="number" class="form-control" name="quantity" value="<?= $i['quantity'] ?>"></div><div class="col-6"><input type="date" class="form-control" name="expiration_date" value="<?= $i['expiration_date'] ?>"></div>
<div class="col-6"><input class="form-control" name="batch_no" value="<?= htmlspecialchars($i['batch_no']) ?>"></div><div class="col-6"><input class="form-control" name="notes" value="<?= htmlspecialchars($i['notes']) ?>"></div>
<div class="col-12"><input type="checkbox" name="is_damaged" value="1" <?= $i['is_damaged']?'checked':'' ?>> Damaged</div></div><div class="modal-footer"><button class="btn btn-primary">Save</button></div></form></div></div></div>
<?php endforeach; ?></tbody></table></div></div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
