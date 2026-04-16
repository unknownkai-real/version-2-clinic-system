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

<div class="card mb-3"><div class="card-body"><h5>Record Student Health Monitoring</h5>
<div class="row g-2">
<div class="col-md-4"><div class="card"><div class="card-header">Physical Exam / Labs</div><div class="card-body"><form method="post" class="row g-2">
<input type="hidden" name="action" value="create_lab">
<div class="col-12"><select class="form-select" name="student_id" required><option value="">Student</option><?php foreach($students as $s): ?><option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['first_name'].' '.$s['last_name']) ?></option><?php endforeach; ?></select></div>
<div class="col-12"><input class="form-control" name="lab_type" placeholder="Lab Type" required></div>
<div class="col-12"><input type="date" class="form-control" name="record_date" required></div>
<div class="col-12"><input class="form-control" name="file_path" placeholder="File Path"></div>
<div class="col-12"><textarea class="form-control" name="result_summary" placeholder="Result Summary"></textarea></div>
<div class="col-12"><button class="btn btn-primary btn-sm">Add Lab Record</button></div></form></div></div></div>

<div class="col-md-4"><div class="card"><div class="card-header">Hepatitis B Vaccination</div><div class="card-body"><form method="post" class="row g-2">
<input type="hidden" name="action" value="create_vax">
<div class="col-12"><select class="form-select" name="student_id" required><option value="">Student</option><?php foreach($students as $s): ?><option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['first_name'].' '.$s['last_name']) ?></option><?php endforeach; ?></select></div>
<div class="col-12"><select class="form-select" name="dose" required><option>1st</option><option>2nd</option><option>3rd</option></select></div>
<div class="col-12"><input type="date" class="form-control" name="record_date" required></div>
<div class="col-12"><input class="form-control" name="file_path" placeholder="File Path"></div>
<div class="col-12"><button class="btn btn-primary btn-sm">Add Vaccination</button></div></form></div></div></div>

<div class="col-md-4"><div class="card"><div class="card-header">Drug Test</div><div class="card-body"><form method="post" class="row g-2">
<input type="hidden" name="action" value="create_drug">
<div class="col-12"><select class="form-select" name="student_id" required><option value="">Student</option><?php foreach($students as $s): ?><option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['first_name'].' '.$s['last_name']) ?></option><?php endforeach; ?></select></div>
<div class="col-12"><input type="date" class="form-control" name="record_date" required></div>
<div class="col-12"><input class="form-control" name="result" placeholder="Result" required></div>
<div class="col-12"><textarea class="form-control" name="notes" placeholder="Notes"></textarea></div>
<div class="col-12"><button class="btn btn-primary btn-sm">Add Drug Test</button></div></form></div></div></div>
</div></div></div>

<div class="card table-wrap mb-3"><div class="card-body">
<div class="d-flex justify-content-between mb-2"><h5>Student Master List</h5><form><input type="hidden" name="route" value="students"><input class="form-control" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search"></form></div>
<table class="table table-striped"><thead><tr><th>Name</th><th>Student No</th><th>Course</th><th>Actions</th></tr></thead><tbody>
<?php foreach($students as $s): ?><tr data-highlight><td><?= htmlspecialchars($s['first_name'].' '.$s['last_name']) ?></td><td><?= htmlspecialchars($s['student_no']) ?></td><td><?= htmlspecialchars($s['course']) ?></td><td>
<form method="post" class="d-inline" onsubmit="return confirm('Delete student?')"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $s['id'] ?>"><button class="btn btn-danger btn-sm">Delete</button></form></td></tr><?php endforeach; ?>
</tbody></table></div></div>

<div class="card mb-3"><div class="card-body"><h6>Lab Records</h6><table class="table table-sm"><thead><tr><th>Student</th><th>Type</th><th>Date</th><th>Actions</th></tr></thead><tbody>
<?php foreach($labs as $r): ?><tr><td><?= htmlspecialchars($r['student_name']) ?></td><td><?= htmlspecialchars($r['lab_type']) ?></td><td><?= htmlspecialchars($r['record_date']) ?></td><td>
<button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#lab<?= $r['id'] ?>">Edit</button>
<form method="post" class="d-inline" onsubmit="return confirm('Delete lab record?')"><input type="hidden" name="action" value="delete_lab"><input type="hidden" name="id" value="<?= $r['id'] ?>"><button class="btn btn-danger btn-sm">Delete</button></form></td></tr>
<div class="modal fade" id="lab<?= $r['id'] ?>"><div class="modal-dialog"><div class="modal-content"><form method="post"><div class="modal-header"><h6>Edit Lab</h6></div><div class="modal-body"><input type="hidden" name="action" value="update_lab"><input type="hidden" name="id" value="<?= $r['id'] ?>"><input class="form-control mb-2" name="student_id" value="<?= $r['student_id'] ?>"><input class="form-control mb-2" name="lab_type" value="<?= htmlspecialchars($r['lab_type']) ?>"><input type="date" class="form-control mb-2" name="record_date" value="<?= $r['record_date'] ?>"><input class="form-control mb-2" name="file_path" value="<?= htmlspecialchars($r['file_path']) ?>"><textarea class="form-control" name="result_summary"><?= htmlspecialchars($r['result_summary']) ?></textarea></div><div class="modal-footer"><button class="btn btn-primary">Save</button></div></form></div></div></div>
<?php endforeach; ?></tbody></table></div></div>

<div class="card mb-3"><div class="card-body"><h6>Vaccination Records</h6><table class="table table-sm"><thead><tr><th>Student</th><th>Dose</th><th>Date</th><th>Actions</th></tr></thead><tbody>
<?php foreach($vaccinations as $v): ?><tr><td><?= htmlspecialchars($v['student_name']) ?></td><td><?= htmlspecialchars($v['dose']) ?></td><td><?= htmlspecialchars($v['record_date']) ?></td><td>
<button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#vax<?= $v['id'] ?>">Edit</button>
<form method="post" class="d-inline" onsubmit="return confirm('Delete vaccination?')"><input type="hidden" name="action" value="delete_vax"><input type="hidden" name="id" value="<?= $v['id'] ?>"><button class="btn btn-danger btn-sm">Delete</button></form></td></tr>
<div class="modal fade" id="vax<?= $v['id'] ?>"><div class="modal-dialog"><div class="modal-content"><form method="post"><div class="modal-header"><h6>Edit Vaccination</h6></div><div class="modal-body"><input type="hidden" name="action" value="update_vax"><input type="hidden" name="id" value="<?= $v['id'] ?>"><input class="form-control mb-2" name="student_id" value="<?= $v['student_id'] ?>"><select class="form-select mb-2" name="dose"><option <?= $v['dose']==='1st'?'selected':'' ?>>1st</option><option <?= $v['dose']==='2nd'?'selected':'' ?>>2nd</option><option <?= $v['dose']==='3rd'?'selected':'' ?>>3rd</option></select><input type="date" class="form-control mb-2" name="record_date" value="<?= $v['record_date'] ?>"><input class="form-control" name="file_path" value="<?= htmlspecialchars($v['file_path']) ?>"></div><div class="modal-footer"><button class="btn btn-primary">Save</button></div></form></div></div></div>
<?php endforeach; ?></tbody></table></div></div>

<div class="card"><div class="card-body"><h6>Drug Test Records</h6><table class="table table-sm"><thead><tr><th>Student</th><th>Date</th><th>Result</th><th>Actions</th></tr></thead><tbody>
<?php foreach($drugTests as $d): ?><tr><td><?= htmlspecialchars($d['student_name']) ?></td><td><?= htmlspecialchars($d['record_date']) ?></td><td><?= htmlspecialchars($d['result']) ?></td><td>
<button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#drug<?= $d['id'] ?>">Edit</button>
<button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#drugView<?= $d['id'] ?>">View</button>
<form method="post" class="d-inline" onsubmit="return confirm('Delete drug test?')"><input type="hidden" name="action" value="delete_drug"><input type="hidden" name="id" value="<?= $d['id'] ?>"><button class="btn btn-danger btn-sm">Delete</button></form></td></tr>
<div class="modal fade" id="drugView<?= $d['id'] ?>"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h6>Drug Test Notes</h6></div><div class="modal-body"><?= nl2br(htmlspecialchars($d['notes'])) ?></div></div></div></div>
<div class="modal fade" id="drug<?= $d['id'] ?>"><div class="modal-dialog"><div class="modal-content"><form method="post"><div class="modal-header"><h6>Edit Drug Test</h6></div><div class="modal-body"><input type="hidden" name="action" value="update_drug"><input type="hidden" name="id" value="<?= $d['id'] ?>"><input class="form-control mb-2" name="student_id" value="<?= $d['student_id'] ?>"><input type="date" class="form-control mb-2" name="record_date" value="<?= $d['record_date'] ?>"><input class="form-control mb-2" name="result" value="<?= htmlspecialchars($d['result']) ?>"><textarea class="form-control" name="notes"><?= htmlspecialchars($d['notes']) ?></textarea></div><div class="modal-footer"><button class="btn btn-primary">Save</button></div></form></div></div></div>
<?php endforeach; ?></tbody></table></div></div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
