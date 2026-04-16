(function(){
  document.querySelectorAll('tr[data-highlight]').forEach(row => {
    row.addEventListener('click', () => {
      row.closest('tbody').querySelectorAll('tr').forEach(r=>r.classList.remove('table-active'));
      row.classList.add('table-active');
    });
  });
})();
