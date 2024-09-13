<?php 
include('koneksi.php');

$journal_details = new journals();
$JD = $journal_details->TampilkanData(1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Journals</title>
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
    <h1>Journals</h1>
    <hr>

    <table>
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>Attendance List ID</th>
            <th>Has Finished</th>
            <th>Has Acc Head Departement</th>
            <th>Lecture ID</th>
            <th>Course ID</th>
            <th>Student Class ID</th>
            <th>Created At</th>
        </tr>

        <?php 
        $no = 1;
        foreach($JD as $row){
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['attendace_list_id']; ?></td>
            <td><?php echo $row['has_finished']; ?></td>
            <td><?php echo $row['has_acc_head_departement']; ?></td>
            <td><?php echo $row['lecture_id']; ?></td>
            <td><?php echo $row['course_id']; ?></td>
            <td><?php echo $row['student_class_id']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
        </tr>
        <?php 
        }
        ?>
    </table>
</body>
</html>
