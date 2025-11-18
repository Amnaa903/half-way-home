<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Registration List</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #E8F4F3;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #2C3E50;
            padding: 20px;
        }
        
        .form-card {
            background: #3D7C77;
            margin: 30px auto;
            padding: 30px;
            width: 90%;
            max-width: 1000px;
            border-radius: 12px;
            color: #ffffff;
            box-shadow: 0 8px 32px rgba(61, 124, 119, 0.3);
        }
        
        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .form-title {
            color: #ffffff;
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 28px;
        }
        
        .form-subtitle {
            color: #C7EAE7;
            font-size: 16px;
        }
        
        .button-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 25px;
        }
        
        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
        }
        
        .btn-light {
            background: #C7EAE7;
            color: #2C3E50;
            border: 2px solid #C7EAE7 !important;
        }
        
        .btn-light:hover {
            background: #9ED8D2;
            border-color: #9ED8D2 !important;
            transform: translateY(-2px);
        }
        
        .btn-light-danger {
            background: #C7EAE7;
            color: #2C3E50;
            border: 2px solid #C7EAE7 !important;
        }
        
        .btn-light-danger:hover {
            background: #9ED8D2;
            border-color: #9ED8D2 !important;
            transform: translateY(-2px);
        }
        
        .btn-submit {
            background: #C7EAE7;
            color: #2C3E50;
            width: 100%;
            padding: 15px;
            font-size: 16px;
            margin-top: 20px;
            border: 2px solid #C7EAE7 !important;
        }
        
        .btn-submit:hover {
            background: #9ED8D2;
            transform: translateY(-2px);
        }
        
        .table-container {
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #C7EAE7;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        table th {
            background: #3D7C77;
            color: white;
            padding: 15px 12px;
            text-align: center;
            font-weight: 600;
            font-size: 14px;
        }
        
        table td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #E8F4F3;
            background: #ffffff;
            color: #2C3E50;
        }
        
        table tr:hover {
            background: #C7EAE7;
        }
        
        .input-field {
            width: 100%;
            padding: 10px 12px;
            border: 2px solid #E8F4F3;
            border-radius: 6px;
            background: #FFFFFF;
            color: #2C3E50;
            font-size: 14px;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }
        
        .input-field:focus {
            outline: none;
            border-color: #9ED8D2;
            box-shadow: 0 0 0 3px rgba(158, 216, 210, 0.2);
        }
        
        .name-field {
            width: 200px;
            min-width: 150px;
        }
        
        .date-field {
            width: 150px;
        }
        
        .cnic-field {
            width: 200px;
        }
        
        .checkbox {
            transform: scale(1.2);
            accent-color: #3D7C77;
        }
        
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }
            
            .form-card {
                width: 95%;
                padding: 20px;
                margin: 20px auto;
            }
            
            .button-container {
                grid-template-columns: 1fr;
            }
            
            table th,
            table td {
                padding: 10px 8px;
                font-size: 13px;
            }
            
            .input-field {
                padding: 8px 10px;
                font-size: 13px;
            }
            
            .name-field {
                width: 120px;
                min-width: 100px;
            }
            
            .date-field {
                width: 120px;
            }
            
            .cnic-field {
                width: 150px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-card">
        <div class="form-header">
            <h1 class="form-title">Create Registration List</h1>
            <p class="form-subtitle">Add participants to the registration list</p>
        </div>
        
        <form id="regForm" method="POST" action="/admissions.registerlist" enctype="multipart/form-data">
            @csrf
            
            <div class="button-container">
                <button type="button" onclick="addRow('dataTable')" class="btn btn-light">
                    <i class="fas fa-plus"></i> Add Row
                </button>
                <button type="button" onclick="deleteRow('dataTable')" class="btn btn-light-danger">
                    <i class="fas fa-trash"></i> Delete Row
                </button>
            </div>
            
            <div class="table-container">
                <table id="dataTable">
                    <thead>
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th style="width: 60px;">ID</th>
                            <th style="width: 200px;">Full Name</th>
                            <th style="width: 150px;">Date</th>
                            <th style="width: 200px;">CNIC</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox" name="chk" class="checkbox"></td>
                            <td>1</td>
                            <td><input type="text" name="rname[]" class="input-field name-field" placeholder="Full name"></td>
                            <td><input type="date" name="reg_date[]" class="input-field date-field"></td>
                            <td><input type="text" name="rcnic[]" class="input-field cnic-field" placeholder="CNIC"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <button type="submit" class="btn btn-submit">
                <i class="fas fa-save"></i> Add to Registration List
            </button>
        </form>
    </div>
</div>

<script>
    function addRow(tableID) {
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;
        if (rowCount >= 21) {
            alert("There can be no more than 20 participants per session.");
            return;
        }
        var row = table.insertRow(rowCount);

        var cell1 = row.insertCell(0);
        var element1 = document.createElement("input");
        element1.type = "checkbox";
        element1.name = "chkbox[]";
        element1.className = "checkbox";
        cell1.appendChild(element1);

        var cell2 = row.insertCell(1);
        cell2.innerHTML = rowCount;

        var cell3 = row.insertCell(2);
        var element2 = document.createElement("input");
        element2.type = "text";
        element2.name = "rname[]";
        element2.className = "input-field name-field";
        element2.placeholder = "Full name";
        cell3.appendChild(element2);

        var cell4 = row.insertCell(3);
        var element3 = document.createElement("input");
        element3.type = "date";
        element3.name = "reg_date[]";
        element3.className = "input-field date-field";
        cell4.appendChild(element3);

        var cell5 = row.insertCell(4);
        var element4 = document.createElement("input");
        element4.type = "text";
        element4.name = "rcnic[]";
        element4.className = "input-field cnic-field";
        element4.placeholder = "CNIC";
        cell5.appendChild(element4);
    }

    function deleteRow(tableID) {
        try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
            for (var i = 0; i < rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if (chkbox && chkbox.checked) {
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }
            }
        } catch (e) {
            alert(e);
        }
    }
</script>

</body>
</html>