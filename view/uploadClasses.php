<?php
  
    $title = "Upload Classes";
    require '../view/headerInclude.php';
   error_reporting(0); // Needed put in for LocalHost
    
?>
    
    <section id="portfolio-information" class="padding-top">
        <div class="container">
            <div class="row">
				<input type="file" id="file" class="btn  btn-common" name="file" />
				<br />
				<a type="button" id="displayFile" class="btn btn-common" onclick="DisplayFile()">Display File</a>
				<a href="#" id="upload" role="button" class="btn btn-common" disabled>Upload Classes(WiP)</a>
				<br /><br />
				<div id="outputDiv">
					<h2>Example</h2>
					<table id="classTable" class="table table-hover table-bordered table-responsive">
						<thead>
							<tr>
								<th>Class Name</th>
								<th>Class Number</th>
								<th>Class Section</th>
								<th>Class Instructor</th>
								<th>Instructor Email</th>
							</tr>
						</thead>
						<tr>
							<td>Intro to Porgramming</td>
							<td>CIS202</td><td>C01</td>
							<td>Jody Strausser</td>
							<td>jstrausser@clarion.edu</td>
						</tr>
						<tr>
							<td>Intro to Porgramming</td>
							<td>CIS202</td>
							<td>C03</td>
							<td>Jody Strausser</td>
							<td>jstrausser@clarion.edu</td>
						</tr>
						<tr>
							<td>Systems Development</td>
							<td>CIS411</td>
							<td>C01</td>
							<td>Jon O'Donnell</td>
							<td>jodennell@clarion.edu</td>
						</tr>
						<tr>
							<td>Computer Forensics</td>
							<td>CIS312</td>
							<td>C01</td>
							<td>Jayakumar Annadatha</td>
							<td>jannadatha@clarion.edu</td>
						</tr>
					</table>
				</div>
            </div>
        </div>
    </section>
    
    <script>
        jQuery(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.document.location = $(this).data("href");
            });
        });
		
		function DisplayFile() {
		var fileUpload = document.getElementById("file");
		var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.csv)$/;
		if (regex.test(fileUpload.value.toLowerCase())) {
			if (typeof (FileReader) != "undefined") {
				var reader = new FileReader();
				reader.onload = function (e) {
					var table = document.createElement("table");
					table.setAttribute("class", "table table-hover table-bordered table-responsive");
					table.setAttribute("id", "classTable");
					var rows = e.target.result.split("\n");
					var haveBody = false;
					var body;
					for (var i = 0; i < rows.length; i++) {
						if(i===0){
							var header = table.createTHead();
							var row = header.insertRow(-1);
							var cells = rows[i].split(",");
							for (var j = 0; j < cells.length; j++) {
								var cell = row.insertCell(-1);
								cell.outerHTML = "<th>" + cells[j] + "</th>";
							}
						}
						else{
							if(!haveBody){
								body = table.appendChild(document.createElement("tbody"));
								haveBody = true;
							}
							var row = body.insertRow(-1);
							var cells = rows[i].split(",");
							for (var j = 0; j < cells.length; j++) {
								var cell = row.insertCell(-1);
								cell.innerHTML = cells[j];
							}
						}
					}
					var outDiv = document.getElementById("outputDiv");
					outDiv.innerHTML = "";
					outDiv.appendChild(table);
				}
				reader.readAsText(fileUpload.files[0]);
				document.getElementById("upload").removeAttribute("disabled");
			} else {
				alert("This browser does not support HTML5.");
			}
		} else {
			alert("Please upload a valid CSV file.");
		}
	}
    </script>
<?php
    require '../view/footerInclude.php';