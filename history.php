<?php
// الاتصال بقاعدة البيانات
$mysqli = new mysqli("localhost", "root", "", "bmi_app");

// فحص الاتصال
if ($mysqli->connect_errno) {
    die("Connection failed: " . $mysqli->connect_error);
}

// استعلام لاسترجاع السجلات
$result = $mysqli->query("SELECT * FROM bmi_records ORDER BY created_at DESC");

// عرض النتائج داخل جدول
echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';
echo '<div class="container mt-5">';
echo '<h2 class="mb-4">BMI History</h2>';
echo '<table class="table table-bordered">';
echo '<thead><tr>
        <th>Name</th>
        <th>Weight</th>
        <th>Height</th>
        <th>BMI</th>
        <th>Interpretation</th>
        <th>Date</th>
      </tr></thead><tbody>';

while($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['name']}</td>
        <td>{$row['weight']}</td>
        <td>{$row['height']}</td>
        <td>" . number_format($row['bmi'], 2) . "</td>
        <td>{$row['interpretation']}</td>
        <td>{$row['created_at']}</td>
    </tr>";
}

echo '</tbody></table></div>';
$mysqli->close();
?>