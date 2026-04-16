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

<div class="card mb-3"><div class="card-body"><div class="d-flex justify-content-between mb-2"><h5>Inventory List</h5><form><input type="hidden" name="route" value="inventory"><input class="form-control" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search..."></form></div>
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

<div class="card"><div class="card-body"><h5>Damaged Items</h5>
<form method="post" class="row g-2 mb-3"><input type="hidden" name="action" value="create_damaged">
<div class="col-md-3"><input class="form-control" name="item_name" placeholder="Item name" required></div>
<div class="col-md-4"><input class="form-control" name="description" placeholder="Description"></div>
<div class="col-md-2"><input type="number" class="form-control" name="quantity" min="1" required></div>
<div class="col-md-2"><input type="date" class="form-control" name="record_date" required></div>
<div class="col-md-1"><button class="btn btn-primary w-100">Add</button></div></form>
<table class="table table-sm"><thead><tr><th>Item</th><th>Description</th><th>Qty</th><th>Date</th><th>Actions</th></tr></thead><tbody>
<?php foreach($damagedItems as $d): ?><tr><td><?= htmlspecialchars($d['item_name']) ?></td><td><?= htmlspecialchars($d['description']) ?></td><td><?= $d['quantity'] ?></td><td><?= htmlspecialchars($d['record_date']) ?></td><td>
<button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#dmg<?= $d['id'] ?>">Edit</button>
<form method="post" class="d-inline" onsubmit="return confirm('Delete damaged item?')"><input type="hidden" name="action" value="delete_damaged"><input type="hidden" name="id" value="<?= $d['id'] ?>"><button class="btn btn-danger btn-sm">Delete</button></form></td></tr>
<div class="modal fade" id="dmg<?= $d['id'] ?>"><div class="modal-dialog"><div class="modal-content"><form method="post"><div class="modal-header"><h6>Edit Damaged Item</h6></div><div class="modal-body"><input type="hidden" name="action" value="update_damaged"><input type="hidden" name="id" value="<?= $d['id'] ?>"><input class="form-control mb-2" name="item_name" value="<?= htmlspecialchars($d['item_name']) ?>"><input class="form-control mb-2" name="description" value="<?= htmlspecialchars($d['description']) ?>"><input type="number" class="form-control mb-2" name="quantity" value="<?= $d['quantity'] ?>"><input type="date" class="form-control" name="record_date" value="<?= $d['record_date'] ?>"></div><div class="modal-footer"><button class="btn btn-primary">Save</button></div></form></div></div></div>
<?php endforeach; ?></tbody></table></div></div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
