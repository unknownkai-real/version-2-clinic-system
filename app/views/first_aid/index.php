<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="card form-card mb-3"><div class="card-body"><h5>First Aid Record</h5>
<form method="post" class="row g-2"><input type="hidden" name="action" value="create">
<div class="col-md-2"><select class="form-select" name="patient_type"><option value="student">Student</option><option value="employee">Employee</option></select></div>
<div class="col-md-2"><input class="form-control" name="patient_id" placeholder="Patient ID" required></div>
<div class="col-md-2"><input type="datetime-local" class="form-control" name="record_datetime" required></div>
<div class="col-md-2"><input class="form-control" name="cause" placeholder="Cause" required></div>
<div class="col-md-2"><input class="form-control" name="first_aid_treatment" placeholder="Treatment" required></div>
<div class="col-md-2"><input class="form-control" name="diagnosis" placeholder="Diagnosis" required></div>
<div class="col-12"><button class="btn btn-primary">Save Record</button></div></form></div></div>
<div class="card"><div class="card-body"><div class="d-flex justify-content-between mb-2"><h5>First Aid List</h5><form><input type="hidden" name="route" value="first-aid"><input class="form-control" name="search" value="<?= htmlspecialchars($search) ?>"></form></div>
<table class="table"><thead><tr><th>Patient</th><th>Date/Time</th><th>Cause</th><th>Treatment</th><th>Actions</th></tr></thead><tbody>
<?php foreach($records as $r): ?><tr data-highlight><td><?= htmlspecialchars($r['patient_name']) ?></td><td><?= htmlspecialchars($r['record_datetime']) ?></td><td><?= htmlspecialchars($r['cause']) ?></td><td><?= htmlspecialchars($r['first_aid_treatment']) ?></td><td>
<button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editFa<?= $r['id'] ?>">Edit</button>
<button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#diag<?= $r['id'] ?>">Diagnosis</button>
<form method="post" class="d-inline" onsubmit="return confirm('Delete record?')"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $r['id'] ?>"><button class="btn btn-danger btn-sm">Delete</button></form></td></tr>
<div class="modal fade" id="diag<?= $r['id'] ?>"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h6>Diagnosis (Confidential)</h6></div><div class="modal-body"><?= htmlspecialchars($r['diagnosis']) ?></div></div></div></div>
<div class="modal fade" id="editFa<?= $r['id'] ?>"><div class="modal-dialog"><div class="modal-content"><form method="post"><div class="modal-header"><h6>Edit First Aid Record</h6></div><div class="modal-body"><input type="hidden" name="action" value="update"><input type="hidden" name="id" value="<?= $r['id'] ?>"><input class="form-control mb-2" name="patient_type" value="<?= $r['student_id']?'student':'employee' ?>"><input class="form-control mb-2" name="patient_id" value="<?= $r['student_id'] ?: $r['employee_id'] ?>"><input type="datetime-local" class="form-control mb-2" name="record_datetime" value="<?= date('Y-m-d\TH:i', strtotime($r['record_datetime'])) ?>"><input class="form-control mb-2" name="cause" value="<?= htmlspecialchars($r['cause']) ?>"><input class="form-control mb-2" name="first_aid_treatment" value="<?= htmlspecialchars($r['first_aid_treatment']) ?>"><input class="form-control" name="diagnosis" value="<?= htmlspecialchars($r['diagnosis']) ?>"></div><div class="modal-footer"><button class="btn btn-primary">Save</button></div></form></div></div></div>
<?php endforeach; ?></tbody></table></div></div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
