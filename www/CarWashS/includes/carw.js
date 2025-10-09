document.addEventListener('DOMContentLoaded', function(){
  const search = document.getElementById('tableSearch');
  const table = document.getElementById('clientTable');

  if (search && table) {
    search.addEventListener('input', function(){
      const q = this.value.toLowerCase().trim();
      const rows = table.tBodies[0].rows;
      for (let r of rows) {
        const text = (r.textContent || r.innerText).toLowerCase();
        r.style.display = text.indexOf(q) !== -1 ? '' : 'none';
      }
    });
  }

  // Basic client-side validation for phone format
  const form = document.querySelector('.client-form');
  if (form) {
    form.addEventListener('submit', function(e){
      const phoneEl = form.querySelector('input[name="phone_number"]');
      if (phoneEl) {
        const v = phoneEl.value.replace(/\D/g,'');
        if (!/^\d{7,13}$/.test(v)) {
          e.preventDefault();
          alert('Please enter a valid phone number (7-13 digits).');
          phoneEl.focus();
        }
      }
    });
  }
});
