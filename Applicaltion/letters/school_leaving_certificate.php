<?php
// Initialize variables for server-side fallback (optional)
$name = $class = $roll = $reg = $contact = $reason = $date = $calendar = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $class = htmlspecialchars($_POST['class']);
    $roll = htmlspecialchars($_POST['roll']);
    $reg = htmlspecialchars($_POST['reg']);
    $contact = htmlspecialchars($_POST['contact']);
    $reason = htmlspecialchars($_POST['reason']);
    $date = htmlspecialchars($_POST['date']);
    $calendar = htmlspecialchars($_POST['calendar']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Universal Leaving Application Generator</title>
<style>
body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; }
.container { display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; }
form { background: #fff; padding: 20px; border-radius: 8px; width: 350px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
form input, form select { width: 100%; padding: 10px; margin: 8px 0; border-radius: 4px; border: 1px solid #ccc; }
form button { padding: 10px 20px; background: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
form button:hover { background: #0056b3; }
.preview { background: #fff; padding: 20px; border-radius: 8px; width: 500px; box-shadow: 0 0 10px rgba(0,0,0,0.1); white-space: pre-line; }
h2 { text-align: center; width: 100%; }
</style>
</head>
<body>

<h2>Universal Leaving Application Generator</h2>

<div class="container">
    <form id="applicationForm">
        <label>Full Name:</label>
        <input type="text" id="name" placeholder="e.g., Dibash Magar" required>

        <label>Class / Program:</label>
        <input type="text" id="class" placeholder="e.g., Class 12 / BBA / MBS" required>

        <label>Roll Number:</label>
        <input type="text" id="roll" required>

        <label>Registration Number:</label>
        <input type="text" id="reg" required>

        <label>Contact Number:</label>
        <input type="text" id="contact" required>

        <label>Reason for Leaving:</label>
        <select id="reason" required>
            <option value="">--Select Reason--</option>
            <option value="completed my studies">Completed my studies</option>
            <option value="transferring to another institution">Transferring to another institution</option>
            <option value="pursuing further studies">Pursuing further studies</option>
            <option value="personal/family reasons">Personal/Family reasons</option>
        </select>

        <label>Date:</label>
        <input type="date" id="date" required>

        <label>Calendar Type:</label>
        <select id="calendar" required>
            <option value="">--Select--</option>
            <option value="AD">AD</option>
            <option value="BS">BS</option>
        </select>
    </form>

    <div class="preview" id="preview">
        Your leaving application preview will appear here...
    </div>
</div>

<script>
const nameInput = document.getElementById('name');
const classInput = document.getElementById('class');
const rollInput = document.getElementById('roll');
const regInput = document.getElementById('reg');
const contactInput = document.getElementById('contact');
const reasonSelect = document.getElementById('reason');
const dateInput = document.getElementById('date');
const calendarSelect = document.getElementById('calendar');
const previewDiv = document.getElementById('preview');

function updatePreview() {
    const name = nameInput.value || "[Your Full Name]";
    const cls = classInput.value || "[Class/Program]";
    const roll = rollInput.value || "[Roll No]";
    const reg = regInput.value || "[Reg No]";
    const contact = contactInput.value || "[Contact No]";
    const reason = reasonSelect.value || "[Reason]";
    const date = dateInput.value || "[Date]";
    const calendar = calendarSelect.value || "[AD/BS]";

    previewDiv.innerText = `
To,
The Principal / Head of Department,
[Name of School/College/University],
[Address]

Subject: Application for Issuance of Leaving Certificate

Respected Sir/Madam,

I am ${name}, a student of ${cls}, bearing Roll No. ${roll} and Registration No. ${reg}.

I hereby request you to kindly issue my Leaving Certificate, as I have ${reason}. I sincerely appreciate your support and guidance during my academic tenure.

I would be grateful if my request is considered at the earliest.

Thanking you.

Yours faithfully,
${name}
Class/Program: ${cls}
Roll No: ${roll}
Reg. No: ${reg}
Contact No: ${contact}
Date: ${date} (${calendar})
    `;
}

// Attach event listeners
[nameInput, classInput, rollInput, regInput, contactInput, reasonSelect, dateInput, calendarSelect].forEach(el => {
    el.addEventListener('input', updatePreview);
    el.addEventListener('change', updatePreview);
});
</script>

</body>
</html>
