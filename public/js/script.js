// Simple form validation for the booking form
document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('bookingForm');
  if(form) {
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      alert('Searching for available rooms...');
      // Optionally, add AJAX call here for real booking search
    });
  }
});
