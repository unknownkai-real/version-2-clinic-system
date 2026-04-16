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
<div class="col-12"><button class="btn btn-primary">Add Employee</button></div></form></div></div>

<div class="card mb-3"><div class="card-body"><h5>Record Employee Health Monitoring</h5>
<form method="post" class="row g-2"><input type="hidden" name="action" value="create_record">
<div class="col-md-3"><select class="form-select" name="employee_id" required><option value="">Employee</option><?php foreach($employees as $e): ?><option value="<?= $e['id'] ?>"><?= htmlspecialchars($e['first_name'].' '.$e['last_name']) ?></option><?php endforeach; ?></select></div>
<div class="col-md-2"><select class="form-select" name="record_type" required><option>Physical Exam</option><option>Drug Test</option><option>Dental Benefits</option></select></div>
<div class="col-md-2"><input type="date" class="form-control" name="record_date" required></div>
<div class="col-md-3"><input class="form-control" name="results" placeholder="Results" required></div>
<div class="col-md-2"><input class="form-control" name="notes" placeholder="Notes"></div>
<div class="col-12"><button class="btn btn-primary">Add Record</button></div></form>
</div></div>

<div class="card mb-3"><div class="card-body"><div class="d-flex justify-content-between mb-2"><h5>Employees</h5><form><input type="hidden" name="route" value="employees"><input class="form-control" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search"></form></div>
<table class="table table-striped"><thead><tr><th>Name</th><th>Department</th><th>Actions</th></tr></thead><tbody>
<?php foreach($employees as $e): ?><tr data-highlight><td><?= htmlspecialchars($e['first_name'].' '.$e['last_name']) ?></td><td><?= htmlspecialchars($e['department']) ?></td><td>
<form method="post" class="d-inline" onsubmit="return confirm('Delete employee?')"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $e['id'] ?>"><button class="btn btn-danger btn-sm">Delete</button></form></td></tr><?php endforeach; ?>
</tbody></table></div></div>

<div class="card"><div class="card-body"><h5>Employee Health Records</h5>
<table class="table"><thead><tr><th>Employee</th><th>Type</th><th>Date</th><th>Results</th><th>Actions</th></tr></thead><tbody>
<?php foreach($records as $r): ?><tr><td><?= htmlspecialchars($r['employee_name']) ?></td><td><?= htmlspecialchars($r['record_type']) ?></td><td><?= htmlspecialchars($r['record_date']) ?></td><td><?= htmlspecialchars($r['results']) ?></td><td>
<button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#er<?= $r['id'] ?>">Edit</button>
<form method="post" class="d-inline" onsubmit="return confirm('Delete record?')"><input type="hidden" name="action" value="delete_record"><input type="hidden" name="id" value="<?= $r['id'] ?>"><button class="btn btn-danger btn-sm">Delete</button></form></td></tr>
<div class="modal fade" id="er<?= $r['id'] ?>"><div class="modal-dialog"><div class="modal-content"><form method="post"><div class="modal-header"><h6>Edit Health Record</h6></div><div class="modal-body"><input type="hidden" name="action" value="update_record"><input type="hidden" name="id" value="<?= $r['id'] ?>"><input class="form-control mb-2" name="employee_id" value="<?= $r['employee_id'] ?>"><select class="form-select mb-2" name="record_type"><option <?= $r['record_type']==='Physical Exam'?'selected':'' ?>>Physical Exam</option><option <?= $r['record_type']==='Drug Test'?'selected':'' ?>>Drug Test</option><option <?= $r['record_type']==='Dental Benefits'?'selected':'' ?>>Dental Benefits</option></select><input type="date" class="form-control mb-2" name="record_date" value="<?= $r['record_date'] ?>"><input class="form-control mb-2" name="results" value="<?= htmlspecialchars($r['results']) ?>"><textarea class="form-control" name="notes"><?= htmlspecialchars($r['notes']) ?></textarea></div><div class="modal-footer"><button class="btn btn-primary">Save</button></div></form></div></div></div>
<?php endforeach; ?></tbody></table></div></div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
