<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Pending Discharge List</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/Bootstrap1.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">

    <!-- jQuery and JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #E8F4F3;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #2C3E50;
        }
        #pendingDischargeForm {
            background-color: #3D7C77;
            margin: 40px auto;
            padding: 30px;
            width: 80%;
            min-width: 300px;
            border: 3px solid #2C3E50 !important;
            border-radius: 12px;
            color: #ffffff;
            box-shadow: 0 8px 32px rgba(61, 124, 119, 0.3);
        }
        h3 {
            text-align: center;
            color: #3D7C77 !important;
            font-weight: 600;
            margin-bottom: 30px;
            font-size: 28px;
        }
        table {
            width: 100%;
            color: #ffffff;
            border-collapse: collapse;
            background-color: #2C3E50;
            border-radius: 8px;
            overflow: hidden;
        }
        table th {
            background-color: #3D7C77;
            color: #ffffff;
            padding: 15px;
            text-align: center;
            font-weight: 600;
            border-bottom: 2px solid #2C3E50;
        }
        table td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #9ED8D2;
            background-color: #FFFFFF !important;
            color: #2C3E50;
        }
        table tr:hover {
            background-color: #3D7C77;
        }
        input[type="text"], input[type="date"] {
            width: 100%;
            padding: 8px 12px;
            border: 2px solid #9ED8D2;
            border-radius: 6px;
            background-color: #ffffff;
            color: #2C3E50;
            font-size: 14px;
            box-sizing: border-box;
        }
        input[type="text"]:focus, input[type="date"]:focus {
            outline: none;
            border-color: #C7EAE7;
            box-shadow: 0 0 5px rgba(199, 234, 231, 0.6);
        }
        input[type="checkbox"] {
            transform: scale(1.2);
            accent-color: #3D7C77;
        }
        button, .btn {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 2px solid #C7EAE7 !important;
            cursor: pointer;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-primary {
            background-color: #C7EAE7;
            color: #2C3E50;
            border: 2px solid #C7EAE7 !important;
        }
        .btn-primary:hover {
            background-color: #9ED8D2;
            border-color: #9ED8D2 !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(158, 216, 210, 0.3);
        }
        .btn-danger {
            background-color: #C7EAE7;
            color: #2C3E50;
            border: 2px solid #C7EAE7 !important;
        }
        .btn-danger:hover {
            background-color: #9ED8D2;
            border-color: #9ED8D2 !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(158, 216, 210, 0.3);
        }
        button[type="submit"] {
            background-color: #C7EAE7;
            color: #2C3E50;
            border: 2px solid #C7EAE7 !important;
            margin-top: 20px;
        }
        button[type="submit"]:hover {
            background-color: #9ED8D2;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(158, 216, 210, 0.3);
        }
        .button-container {
            width: 100%;
            text-align: center;
            margin-bottom: 25px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        .alert {
            background-color: #C7EAE7;
            color: #2C3E50;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 5px solid #9ED8D2;
        }
        .alert-success {
            background-color: #C7EAE7;
            border-left: 5px solid #3D7C77;
        }
        .alert-danger {
            background-color: #FF6B6B;
            color: white;
            border-left: 5px solid #FF5252;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            #pendingDischargeForm {
                width: 95%;
                padding: 20px;
                margin: 20px auto;
            }
            .button-container {
                grid-template-columns: 1fr;
            }
            table {
                font-size: 14px;
            }
            input[type="text"], input[type="date"] {
                padding: 6px 10px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    
    <h3>Create Pending Discharge List</h3>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        
    <form id="pendingDischargeForm" method="POST" action="{{ route('incharge.discharge.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="button-container">
            <input type="button" value="Add Row" onclick="addRow('pendingDischargeTable')" class="btn btn-primary">
            <input type="button" value="Delete Row" onclick="deleteRow('pendingDischargeTable')" class="btn btn-danger">
        </div>
        <div style="overflow-x: auto;">
            <table id="pendingDischargeTable">
                <tr>
                    <th>#</th>
                    <th>Select</th>
                    <th>Full Name</th>
                    <th>Discharge Date</th>
                    <th>CNIC</th>
                    <th>Admission Date</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td><input type="checkbox" name="chk"></td>
                    <td><input type="text" name="resident_name[]" required></td>
                    <td><input type="date" name="discharge_date[]" required></td>
                    <td><input type="text" name="cnic[]" required></td>
                    <td><input type="date" name="admission_date[]" required></td>
                </tr>
            </table>
        </div>
        <br>
        <button type="submit">Add to Pending Discharge List</button>
    </form>
</div>

<!-- JavaScript -->
<script>
    function addRow(tableID) {
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;
        if (rowCount >= 21) {
            alert("There can be no more than 20 residents per session.");
            return;
        }
        var row = table.insertRow(rowCount);

        var cell1 = row.insertCell(0);
        cell1.innerHTML = rowCount;

        var cell2 = row.insertCell(1);
        var element1 = document.createElement("input");
        element1.type = "checkbox";
        element1.name = "chkbox[]";
        cell2.appendChild(element1);

        var cell3 = row.insertCell(2);
        var element2 = document.createElement("input");
        element2.type = "text";
        element2.name = "resident_name[]";
        element2.required = true;
        cell3.appendChild(element2);

        var cell4 = row.insertCell(3);
        var element3 = document.createElement("input");
        element3.type = "date";
        element3.name = "discharge_date[]";
        element3.required = true;
        cell4.appendChild(element3);

        var cell5 = row.insertCell(4);
        var element4 = document.createElement("input");
        element4.type = "text";
        element4.name = "cnic[]";
        element4.required = true;
        cell5.appendChild(element4);

        var cell6 = row.insertCell(5);
        var element5 = document.createElement("input");
        element5.type = "date";
        element5.name = "admission_date[]";
        element5.required = true;
        cell6.appendChild(element5);
    }

    function deleteRow(tableID) {
        try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
            for (var i = 1; i < rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[1].childNodes[0];
                if (chkbox && chkbox.checked) {
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                    
                    // Update row numbers
                    for (var j = 1; j < rowCount; j++) {
                        table.rows[j].cells[0].innerHTML = j;
                    }
                }
            }
        } catch (e) {
            alert(e);
        }
    }

    // Update row numbers when page loads
    document.addEventListener('DOMContentLoaded', function() {
        var table = document.getElementById('pendingDischargeTable');
        for (var i = 1; i < table.rows.length; i++) {
            table.rows[i].cells[0].innerHTML = i;
        }
    });
</script>

</body>
</html>