<option value="">Select Patient</option>
<?php foreach ($students as $s): ?><option value="student:<?= $s['id'] ?>">Student - <?= htmlspecialchars($s['first_name'].' '.$s['last_name']) ?></option><?php endforeach; ?>
<?php foreach ($employees as $e): ?><option value="employee:<?= $e['id'] ?>">Employee - <?= htmlspecialchars($e['first_name'].' '.$e['last_name']) ?></option><?php endforeach; ?>
