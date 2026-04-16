<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="card form-card mb-3"><div class="card-body"><h5>Clinic Admission / Visit</h5>
<form method="post" class="row g-2"><input type="hidden" name="action" value="create">
<div class="col-md-2"><select class="form-select" name="patient_type" required><option value="student">Student</option><option value="employee">Employee</option></select></div>
<div class="col-md-3"><select class="form-select" name="patient_id" required><?php foreach($students as $s): ?><option value="<?= $s['id'] ?>">S: <?= htmlspecialchars($s['first_name'].' '.$s['last_name']) ?></option><?php endforeach; ?></select></div>
<div class="col-md-2"><input type="datetime-local" class="form-control" name="visit_datetime" required></div>
<div class="col-md-2"><input class="form-control" name="complaint" placeholder="Complaint" required></div>
<div class="col-md-2"><input class="form-control" name="intervention" placeholder="Intervention"></div>
<div class="col-md-1"><input class="form-control" name="disposition" placeholder="Disposition"></div>
<div class="col-12"><textarea class="form-control" name="private_notes" placeholder="Private notes (opens in modal on edit)"></textarea></div>
<div class="col-12"><button class="btn btn-primary">Save Visit</button></div></form></div></div>
<div class="card"><div class="card-body"><div class="d-flex justify-content-between mb-2"><h5>Visit Logs</h5><form><input type="hidden" name="route" value="visits"><input class="form-control" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search..."></form></div>
<table class="table"><thead><tr><th>Date/Time</th><th>Patient</th><th>Complaint</th><th>Disposition</th><th>Actions</th></tr></thead><tbody>
<?php foreach($visits as $v): ?><tr data-highlight><td><?= htmlspecialchars($v['visit_datetime']) ?></td><td><?= htmlspecialchars($v['patient_name']) ?></td><td><?= htmlspecialchars($v['complaint']) ?></td><td><?= htmlspecialchars($v['disposition']) ?></td><td>
<button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editVisit<?= $v['id'] ?>">Edit</button>
<button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#noteVisit<?= $v['id'] ?>">Private Note</button>
<form method="post" class="d-inline" onsubmit="return confirm('Delete visit?')"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $v['id'] ?>"><button class="btn btn-sm btn-danger">Delete</button></form></td></tr>
<div class="modal fade" id="noteVisit<?= $v['id'] ?>"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h6>Private Notes</h6></div><div class="modal-body"><?= nl2br(htmlspecialchars($v['private_notes'])) ?></div></div></div></div>
<div class="modal fade" id="editVisit<?= $v['id'] ?>"><div class="modal-dialog"><div class="modal-content"><form method="post"><div class="modal-header"><h6>Edit Visit</h6></div><div class="modal-body row g-2"><input type="hidden" name="action" value="update"><input type="hidden" name="id" value="<?= $v['id'] ?>">
<div class="col-6"><select class="form-select" name="patient_type"><option value="student" <?= $v['student_id']?'selected':'' ?>>Student</option><option value="employee" <?= $v['employee_id']?'selected':'' ?>>Employee</option></select></div>
<div class="col-6"><input class="form-control" name="patient_id" value="<?= $v['student_id'] ?: $v['employee_id'] ?>"></div>
<div class="col-12"><input type="datetime-local" class="form-control" name="visit_datetime" value="<?= date('Y-m-d\TH:i', strtotime($v['visit_datetime'])) ?>"></div>
<div class="col-12"><input class="form-control" name="complaint" value="<?= htmlspecialchars($v['complaint']) ?>"></div><div class="col-12"><input class="form-control" name="intervention" value="<?= htmlspecialchars($v['intervention']) ?>"></div><div class="col-12"><input class="form-control" name="disposition" value="<?= htmlspecialchars($v['disposition']) ?>"></div><div class="col-12"><textarea class="form-control" name="private_notes"><?= htmlspecialchars($v['private_notes']) ?></textarea></div>
</div><div class="modal-footer"><button class="btn btn-primary">Save</button></div></form></div></div></div>
<?php endforeach; ?></tbody></table></div></div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
