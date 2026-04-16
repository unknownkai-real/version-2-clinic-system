<?php require __DIR__ . '/../layouts/header.php'; ?>
<div class="card form-card mb-3"><div class="card-body">
<h5>Doctor Consultation</h5>
<form method="post" class="row g-2">
<input type="hidden" name="action" value="create">
<input type="hidden" name="patient_id" id="patient_id" required>
<div class="col-md-2"><select class="form-select" name="patient_type" id="patient_type"><option>Student</option><option>Employee</option></select></div>
<div class="col-md-3 position-relative"><input class="form-control" id="patient_search" placeholder="Search patient" autocomplete="off" required><div id="patient_results" class="list-group position-absolute w-100" style="z-index:1050;"></div></div>
<div class="col-md-2"><input type="datetime-local" class="form-control" name="consult_datetime" required></div>
<div class="col-md-2"><input class="form-control" name="complaint" placeholder="Complaint" required></div>
<div class="col-md-2"><input class="form-control" name="intervention" placeholder="Intervention"></div>
<div class="col-md-1"><input class="form-control" name="disposition" placeholder="Disposition"></div>
<div class="col-12"><textarea class="form-control" name="private_notes" placeholder="Confidential notes"></textarea></div>
<div class="col-12"><button class="btn btn-primary">Add Consultation</button></div>
</form>
</div></div>

<div class="card"><div class="card-body">
<div class="d-flex justify-content-between mb-2"><h5>Consultation List</h5><form><input type="hidden" name="route" value="consultations"><input class="form-control" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search"></form></div>
<div class="table-responsive"><table class="table table-striped"><thead><tr><th>Date/Time</th><th>Patient</th><th>Type</th><th>Complaint</th><th>Intervention</th><th>Actions</th></tr></thead><tbody>
<?php foreach($consultations as $c): ?><tr data-highlight>
<td><?= htmlspecialchars($c['consult_datetime']) ?></td><td><?= htmlspecialchars($c['patient_name']) ?></td><td><?= htmlspecialchars($c['patient_type']) ?></td><td><?= htmlspecialchars($c['complaint']) ?></td><td><?= htmlspecialchars($c['intervention']) ?></td>
<td>
<button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editCon<?= $c['id'] ?>">Edit</button>
<button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#noteCon<?= $c['id'] ?>">Private Notes</button>
<form method="post" class="d-inline" onsubmit="return confirm('Delete consultation?')"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= $c['id'] ?>"><button class="btn btn-sm btn-danger">Delete</button></form>
</td></tr>
<div class="modal fade" id="noteCon<?= $c['id'] ?>"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h6>Confidential Notes</h6></div><div class="modal-body"><?= nl2br(htmlspecialchars($c['private_notes'])) ?></div></div></div></div>
<div class="modal fade" id="editCon<?= $c['id'] ?>"><div class="modal-dialog"><div class="modal-content"><form method="post"><div class="modal-header"><h6>Edit Consultation</h6></div><div class="modal-body row g-2">
<input type="hidden" name="action" value="update"><input type="hidden" name="id" value="<?= $c['id'] ?>">
<div class="col-6"><select class="form-select" name="patient_type"><option <?= $c['patient_type']==='Student'?'selected':'' ?>>Student</option><option <?= $c['patient_type']==='Employee'?'selected':'' ?>>Employee</option></select></div>
<div class="col-6"><input class="form-control" name="patient_id" value="<?= (int)$c['patient_id'] ?>" required></div>
<div class="col-12"><input type="datetime-local" class="form-control" name="consult_datetime" value="<?= date('Y-m-d\TH:i', strtotime($c['consult_datetime'])) ?>" required></div>
<div class="col-12"><input class="form-control" name="complaint" value="<?= htmlspecialchars($c['complaint']) ?>" required></div>
<div class="col-12"><input class="form-control" name="intervention" value="<?= htmlspecialchars($c['intervention']) ?>"></div>
<div class="col-12"><input class="form-control" name="disposition" value="<?= htmlspecialchars($c['disposition']) ?>"></div>
<div class="col-12"><textarea class="form-control" name="private_notes"><?= htmlspecialchars($c['private_notes']) ?></textarea></div>
</div><div class="modal-footer"><button class="btn btn-primary">Save</button></div></form></div></div></div>
<?php endforeach; ?></tbody></table></div>
</div></div>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
