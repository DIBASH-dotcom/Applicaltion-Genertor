<?php
// index.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dependent Dropdown Letter Generator</title>
<style>
* {margin:0;padding:0;box-sizing:border-box;font-family:Arial,sans-serif;}
body {display:flex;flex-direction:column;min-height:100vh;background-color:#f5f6fa;}
nav {background-color:#2c3e50;color:#fff;padding:10px 20px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;}
nav .logo {font-size:20px;font-weight:bold;}
nav ul {list-style:none;display:flex;align-items:center;flex-wrap:wrap;}
nav ul li {margin-left:20px;}
nav ul li a {color:#fff;text-decoration:none;padding:5px 10px;display:block;}
nav ul li:hover {background-color:#34495e;border-radius:5px;}
.container {display:flex;flex:1;padding:20px;gap:20px;flex-wrap:wrap;}
.main-content {flex:1;background-color:#ecf0f1;padding:20px;border-radius:10px;min-height:400px;}
.preview-content {flex:1;background-color:#fff;border:1px solid #ccc;padding:20px;border-radius:10px;min-height:400px;white-space:pre-wrap;}
footer {background-color:#2c3e50;color:#fff;text-align:center;padding:15px;margin-top:auto;}
input[type=text], input[type=date], textarea, select, input[type=submit] {width:100%;padding:10px;margin-top:5px;border-radius:5px;border:1px solid #ccc;font-size:16px;}
input[type=submit] {background-color:#2c3e50;color:#fff;cursor:pointer;transition:0.3s;}
input[type=submit]:hover {background-color:#34495e;}
@media(max-width:768px) {
    .container {flex-direction:column;}
    nav ul {flex-direction:column;width:100%;}
    nav ul li {margin-left:0;margin-top:5px;}
    input[type=text], input[type=date], textarea, select, input[type=submit] {font-size:14px;padding:8px;}
}
</style>
<script>
// Populate subcategories
function updateSubCategory() {
    const category = document.getElementById("category").value;
    const subCategory = document.getElementById("subCategory");
    subCategory.innerHTML = "<option value=''>-- Select Letter Type --</option>";

    const options = {
        school: [
           {name :" Applicaltion For Leave", file: "Applicaltion_Leave"},
            {name: "School Leaving Certificate", file: "school_leaving_certificate"},
            "Fee Concession",
            "Change Subject",
            "Transfer Certificate"
        ],
        office: [
            "Job Application Letter",
            "Resignation Letter",
            "Leave Application for Office",
            "Request for Salary Increment"
        ],
        personal: [
            "Letter to a Friend",
            "Electricity Connection",
            "Request for Address Change",
            "Complaint Letter"
        ]
    };

    (options[category] || []).forEach(item => {
    const opt = document.createElement("option");

    if (typeof item === 'object') {
        opt.value = item.file; 
        opt.text = item.name;
    } else {
        // For string items, use the string itself as value and text
        opt.value = item.replace(/\s+/g, "_").toLowerCase(); // safe filename
        opt.text = item;
    }

    subCategory.appendChild(opt);
});
s
}

// Load selected letter template
function showForm() {
    const letterType = document.getElementById("subCategory").value;
    const preview = document.getElementById("preview");

    if (letterType) {
        fetch("letters/" + letterType + ".php")
            .then(response => response.ok ? response.text() : Promise.reject("Template not found"))
            .then(data => preview.innerHTML = data)
            .catch(err => preview.innerHTML = "<p style='color:red'>Error loading letter template.</p>");
    } else {
        preview.innerHTML = "<p>After selecting the letter type and filling the form, your letter will appear here.</p>";
    }
}
</script>
</head>
<body>

<nav>
    <div class="logo">Letter Generator</div>
    <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Contact Us</a></li>
    </ul>
</nav>

<p>
    Please select a <strong>Category</strong> and then choose the <strong>Letter Type</strong>. 
    Fill the form that appears and see the live preview on the right.
</p>

<div class="container">
    <div class="main-content">
        <h2>Letter Generator</h2>

        <label>Category:</label>
        <select id="category" onchange="updateSubCategory()">
            <option value="">-- Select Category --</option>
            <option value="school">School / College</option>
            <option value="office">Office / Job</option>
            <option value="personal">Personal / General</option>
        </select><br><br>

        <label>Letter Type:</label>
        <select id="subCategory" onchange="showForm()">
            <option value="">-- Select Letter Type --</option>
        </select><br><br>

        <div class="preview-content" id="preview">
            <h3>Letter Preview</h3>
            <p>After selecting the letter type and filling the form, your letter will appear here.</p>
        </div>
    </div>
</div>

<footer>
    &copy; Developed by Dibash Magar <?php echo date("Y"); ?>
</footer>

</body>
</html>
