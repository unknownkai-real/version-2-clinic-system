<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="card form-card mb-3"><div class="card-body"><h5>Student Registration</h5>
<form method="post" class="row g-2">
<input type="hidden" name="action" value="create">
<div class="col-md-2"><input class="form-control" name="student_no" placeholder="Student No" required></div>
<div class="col-md-2"><input class="form-control" name="first_name" placeholder="First Name" required></div>
<div class="col-md-2"><input class="form-control" name="last_name" placeholder="Last Name" required></div>
<div class="col-md-2"><input class="form-control" name="course" placeholder="Course"></div>
<div class="col-md-1"><input class="form-control" name="year_level" placeholder="Year"></div>
<div class="col-md-2"><input type="date" class="form-control" name="birth_date"></div>
<div class="col-md-1"><select class="form-select" name="sex"><option>Male</option><option>Female</option></select></div>
<div class="col-12"><button class="btn btn-primary">Add Student</button></div>
</form></div></div>
<div class="card table-wrap"><div class="card-body">
<div class="d-flex justify-content-between mb-2"><h5>Student Health Records</h5><form><input type="hidden" name="route" value="students"><input class="form-control" name="search" placeholder="Search..." value="<?= htmlspecialchars($search) ?>"></form></div>
<table class="table table-striped"><thead><tr><th>Name</th><th>Student No</th><th>Course</th><th>Actions</th></tr></thead><tbody>
<?php foreach($students as $s): ?><tr data-highlight>
<td><button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#history<?= $s['id'] ?>"><?= htmlspecialchars($s['first_name'].' '.$s['last_name']) ?></button></td>
<td><?= htmlspecialchars($s['student_no']) ?></td><td><?= htmlspecialchars($s['course']) ?></td>
<td><button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $s['id'] ?>">Edit</button>
<form method="post" class="d-inline" onsubmit="return confirm('Delete this record?')"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $s['id'] ?>"><button class="btn btn-sm btn-danger">Delete</button></form></td></tr>
<div class="modal fade" id="edit<?= $s['id'] ?>"><div class="modal-dialog"><div class="modal-content"><form method="post"><div class="modal-header"><h6>Edit Student</h6></div><div class="modal-body row g-2">
<input type="hidden" name="action" value="update"><input type="hidden" name="id" value="<?= $s['id'] ?>">
<div class="col-6"><input class="form-control" name="student_no" value="<?= htmlspecialchars($s['student_no']) ?>"></div>
<div class="col-6"><input class="form-control" name="course" value="<?= htmlspecialchars($s['course']) ?>"></div>
<div class="col-6"><input class="form-control" name="first_name" value="<?= htmlspecialchars($s['first_name']) ?>"></div>
<div class="col-6"><input class="form-control" name="last_name" value="<?= htmlspecialchars($s['last_name']) ?>"></div>
<div class="col-6"><input class="form-control" name="year_level" value="<?= htmlspecialchars($s['year_level']) ?>"></div>
<div class="col-6"><input type="date" class="form-control" name="birth_date" value="<?= $s['birth_date'] ?>"></div>
<div class="col-12"><select class="form-select" name="sex"><option <?= $s['sex']==='Male'?'selected':'' ?>>Male</option><option <?= $s['sex']==='Female'?'selected':'' ?>>Female</option></select></div></div>
<div class="modal-footer"><button class="btn btn-primary">Save</button></div></form></div></div></div>
<div class="modal fade" id="history<?= $s['id'] ?>"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><h6><?= htmlspecialchars($s['first_name'].' '.$s['last_name']) ?> Full History</h6></div><div class="modal-body">
<h6>Vaccinations (Hepatitis B)</h6><ul><?php foreach($s['history']['vaccinations'] as $v): ?><li><?= htmlspecialchars($v['vaccine_name'].' '.$v['dose'].' on '.$v['date_administered']) ?></li><?php endforeach; ?></ul>
<h6>Physical/Lab/Drug Test (Confidential in modal)</h6><ul><?php foreach($s['history']['labs'] as $l): ?><li><?= htmlspecialchars($l['test_type'].': '.$l['result'].' ('.$l['test_date'].')') ?></li><?php endforeach; ?></ul>
</div></div></div></div>
<?php endforeach; ?></tbody></table>
</div></div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
