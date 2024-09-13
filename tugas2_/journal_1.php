<?php 
include('koneksi.php');
$JDS = new journal_details();
$Journal_details = $JDS->TampilkanData(101); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Journal Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h1 {
            margin-top: 20px;
            color: #333;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 90%;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border: 1px solid #ddd;
            word-wrap: break-word;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        td {
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Journal Details</h1>
    <hr>

    <table>
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>Material</th>
            <th>His Acc Student</th>
            <th>His Acc Lecture</th>
            <th>Attendance List Detail ID</th>
            <th>Journal ID</th>
            <th>Created At</th>
        </tr>

        <?php 
        $no = 1;
        foreach($Journal_details as $row){
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['material']; ?></td>
            <td><?php echo $row['his_acc_Student']; ?></td>
            <td><?php echo $row['his_acc_Lecture']; ?></td>
            <td><?php echo $row['attendance_list_detail_id']; ?></td>
            <td><?php echo $row['journal_id']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
        </tr>
        <?php 
        }
        ?>
    </table>
</body>
</html>
