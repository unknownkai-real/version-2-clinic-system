(function(){
  document.querySelectorAll('tr[data-highlight]').forEach(row => {
    row.addEventListener('click', () => {
      row.closest('tbody').querySelectorAll('tr').forEach(r=>r.classList.remove('table-active'));
      row.classList.add('table-active');
    });
  });

  const typeSelect = document.getElementById('patient_type');
  const searchInput = document.getElementById('patient_search');
  const hiddenId = document.getElementById('patient_id');
  const resultsBox = document.getElementById('patient_results');

  if (typeSelect && searchInput && hiddenId && resultsBox) {
    const loadPatients = async () => {
      const q = searchInput.value.trim();
      if (q.length < 1) {
        resultsBox.innerHTML = '';
        return;
      }
      const url = `index.php?route=consultations/patient-search&patient_type=${encodeURIComponent(typeSelect.value)}&q=${encodeURIComponent(q)}`;
      const res = await fetch(url);
      const data = await res.json();
      resultsBox.innerHTML = '';
      data.forEach((p) => {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'list-group-item list-group-item-action';
        btn.textContent = `${p.full_name} (ID: ${p.id})`;
        btn.addEventListener('click', () => {
          searchInput.value = p.full_name;
          hiddenId.value = p.id;
          resultsBox.innerHTML = '';
        });
        resultsBox.appendChild(btn);
      });
    };

    searchInput.addEventListener('input', loadPatients);
    typeSelect.addEventListener('change', () => {
      hiddenId.value = '';
      searchInput.value = '';
      resultsBox.innerHTML = '';
    });
  }
})();
