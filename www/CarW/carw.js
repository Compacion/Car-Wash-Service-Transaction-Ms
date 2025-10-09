// carw.js — small client-side enhancements: search and validation

document.addEventListener('DOMContentLoaded', function () {
  const search = document.getElementById('tableSearch');
  const table = document.getElementById('clientTable');
  const form = document.getElementById('clientForm');

  if (search && table) {
    search.addEventListener('input', function () {
      const q = this.value.toLowerCase().trim();
      const rows = table.tBodies[0].rows;
      for (let r of rows) {
        const text = (r.textContent || r.innerText).toLowerCase();
        r.style.display = text.indexOf(q) !== -1 ? '' : 'none';
      }
    });
  }

  if (form) {
    form.addEventListener('submit', function (e) {
      const phone = document.getElementById('phone_number');
      if (phone) {
        const v = phone.value.replace(/\s|-/g, '');
        // basic validation: allow digits, 10-13 chars
        if (!/^\d{7,13}$/.test(v)) {
          e.preventDefault();
          alert('Please enter a valid phone number (7-13 digits).');
          phone.focus();
        }
      }
    });
  }
});
