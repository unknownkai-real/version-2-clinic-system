<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="card form-card mb-3"><div class="card-body"><h5>Employee Registration</h5>
<form method="post" class="row g-2"><input type="hidden" name="action" value="create">
<div class="col-md-2"><input class="form-control" name="employee_no" placeholder="Employee No" required></div>
<div class="col-md-2"><input class="form-control" name="first_name" placeholder="First Name" required></div>
<div class="col-md-2"><input class="form-control" name="last_name" placeholder="Last Name" required></div>
<div class="col-md-2"><input class="form-control" name="department" placeholder="Department"></div>
<div class="col-md-2"><input class="form-control" name="position" placeholder="Position"></div>
<div class="col-md-2"><input type="date" class="form-control" name="birth_date"></div>
<div class="col-md-2"><select class="form-select" name="sex"><option>Male</option><option>Female</option></select></div>
<div class="col-md-2"><input class="form-control" name="physical_exam" placeholder="Physical Exam"></div>
<div class="col-md-2"><input class="form-control" name="drug_test" placeholder="Drug Test"></div>
<div class="col-md-2"><input class="form-control" name="dental_benefits" placeholder="Dental Benefits"></div>
<div class="col-12"><button class="btn btn-primary">Add Employee</button></div></form></div></div>
<div class="card"><div class="card-body"><div class="d-flex justify-content-between mb-2"><h5>Employees</h5><form><input type="hidden" name="route" value="employees"><input class="form-control" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search..."></form></div>
<table class="table table-striped"><thead><tr><th>Name</th><th>Department</th><th>Actions</th></tr></thead><tbody>
<?php foreach($employees as $e): ?><tr data-highlight><td><button class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#detail<?= $e['id'] ?>"><?= htmlspecialchars($e['first_name'].' '.$e['last_name']) ?></button></td><td><?= htmlspecialchars($e['department']) ?></td><td>
<button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editE<?= $e['id'] ?>">Edit</button>
<form method="post" class="d-inline" onsubmit="return confirm('Delete this record?')"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $e['id'] ?>"><button class="btn btn-danger btn-sm">Delete</button></form>
</td></tr>
<div class="modal fade" id="detail<?= $e['id'] ?>"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h6>Employee History</h6></div><div class="modal-body">
<ul class="nav nav-tabs"><li class="nav-item"><span class="nav-link active">Health Summary</span></li></ul>
<p><strong>Physical Exam:</strong> <?= htmlspecialchars($e['physical_exam']) ?></p><p><strong>Drug Test:</strong> <?= htmlspecialchars($e['drug_test']) ?></p><p><strong>Dental Benefits:</strong> <?= htmlspecialchars($e['dental_benefits']) ?></p>
</div></div></div></div>
<div class="modal fade" id="editE<?= $e['id'] ?>"><div class="modal-dialog"><div class="modal-content"><form method="post"><div class="modal-header"><h6>Edit Employee</h6></div><div class="modal-body row g-2">
<input type="hidden" name="action" value="update"><input type="hidden" name="id" value="<?= $e['id'] ?>">
<div class="col-6"><input class="form-control" name="employee_no" value="<?= htmlspecialchars($e['employee_no']) ?>"></div><div class="col-6"><input class="form-control" name="department" value="<?= htmlspecialchars($e['department']) ?>"></div>
<div class="col-6"><input class="form-control" name="first_name" value="<?= htmlspecialchars($e['first_name']) ?>"></div><div class="col-6"><input class="form-control" name="last_name" value="<?= htmlspecialchars($e['last_name']) ?>"></div>
<div class="col-6"><input class="form-control" name="position" value="<?= htmlspecialchars($e['position']) ?>"></div><div class="col-6"><input type="date" class="form-control" name="birth_date" value="<?= $e['birth_date'] ?>"></div>
<div class="col-4"><input class="form-control" name="physical_exam" value="<?= htmlspecialchars($e['physical_exam']) ?>"></div><div class="col-4"><input class="form-control" name="drug_test" value="<?= htmlspecialchars($e['drug_test']) ?>"></div><div class="col-4"><input class="form-control" name="dental_benefits" value="<?= htmlspecialchars($e['dental_benefits']) ?>"></div>
<div class="col-12"><select class="form-select" name="sex"><option <?= $e['sex']==='Male'?'selected':'' ?>>Male</option><option <?= $e['sex']==='Female'?'selected':'' ?>>Female</option></select></div></div><div class="modal-footer"><button class="btn btn-primary">Save</button></div></form></div></div></div>
<?php endforeach; ?></tbody></table></div></div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
