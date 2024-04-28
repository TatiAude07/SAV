
function validateForm() {
  var meetingTime = document.getElementById("meetingTime").value;
  if (meetingTime === '') {
    alert("L'heure de réunion est requise.");
    return false;
  }
  return true;
}