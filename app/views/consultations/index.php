<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="card form-card mb-3"><div class="card-body"><h5>Doctor Consultation</h5>
<form method="post" class="row g-2"><input type="hidden" name="action" value="create">
<div class="col-md-2"><select class="form-select" name="patient_type"><option value="student">Student</option><option value="employee">Employee</option></select></div>
<div class="col-md-2"><input class="form-control" name="patient_id" placeholder="Patient ID" required></div>
<div class="col-md-2"><input type="date" class="form-control" name="consultation_date" required></div>
<div class="col-md-2"><input class="form-control" name="complaint" placeholder="Complaint" required></div>
<div class="col-md-2"><input class="form-control" name="diagnosis" placeholder="Diagnosis" required></div>
<div class="col-md-2"><input class="form-control" name="treatment" placeholder="Treatment"></div>
<div class="col-12"><textarea class="form-control" name="confidential_notes" placeholder="Confidential notes"></textarea></div>
<div class="col-12"><button class="btn btn-primary">Record Consultation</button></div></form></div></div>
<div class="card"><div class="card-body"><div class="d-flex justify-content-between mb-2"><h5>Consultations</h5><form><input type="hidden" name="route" value="consultations"><input class="form-control" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search..."></form></div>
<table class="table"><thead><tr><th>Date</th><th>Patient</th><th>Complaint</th><th>Diagnosis</th><th>Actions</th></tr></thead><tbody>
<?php foreach($consultations as $c): ?><tr data-highlight><td><?= htmlspecialchars($c['consultation_date']) ?></td><td><?= htmlspecialchars($c['patient_name']) ?></td><td><?= htmlspecialchars($c['complaint']) ?></td><td><?= htmlspecialchars($c['diagnosis']) ?></td><td>
<button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editCon<?= $c['id'] ?>">Edit</button>
<button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#noteCon<?= $c['id'] ?>">Confidential</button>
<form method="post" class="d-inline" onsubmit="return confirm('Delete consultation?')"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $c['id'] ?>"><button class="btn btn-danger btn-sm">Delete</button></form></td></tr>
<div class="modal fade" id="noteCon<?= $c['id'] ?>"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h6>Confidential Notes</h6></div><div class="modal-body"><?= nl2br(htmlspecialchars($c['confidential_notes'])) ?></div></div></div></div>
<div class="modal fade" id="editCon<?= $c['id'] ?>"><div class="modal-dialog"><div class="modal-content"><form method="post"><div class="modal-header"><h6>Edit Consultation</h6></div><div class="modal-body"><input type="hidden" name="action" value="update"><input type="hidden" name="id" value="<?= $c['id'] ?>"><input class="form-control mb-2" name="patient_type" value="<?= $c['student_id']?'student':'employee' ?>"><input class="form-control mb-2" name="patient_id" value="<?= $c['student_id'] ?: $c['employee_id'] ?>"><input type="date" class="form-control mb-2" name="consultation_date" value="<?= $c['consultation_date'] ?>"><input class="form-control mb-2" name="complaint" value="<?= htmlspecialchars($c['complaint']) ?>"><input class="form-control mb-2" name="diagnosis" value="<?= htmlspecialchars($c['diagnosis']) ?>"><input class="form-control mb-2" name="treatment" value="<?= htmlspecialchars($c['treatment']) ?>"><textarea class="form-control" name="confidential_notes"><?= htmlspecialchars($c['confidential_notes']) ?></textarea></div><div class="modal-footer"><button class="btn btn-primary">Save</button></div></form></div></div></div>
<?php endforeach; ?></tbody></table></div></div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
