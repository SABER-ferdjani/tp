<?php
// الاتصال بقاعدة البيانات
$mysqli = new mysqli("localhost", "root", "", "bmi_app");

// التحقق من الاتصال بقاعدة البيانات
if ($mysqli->connect_errno) {
    echo "فشل الاتصال بقاعدة البيانات: " . $mysqli->connect_error;
    exit;
}

// استقبال البيانات
if (isset($_POST['name'], $_POST['weight'], $_POST['height'])) {
    $name = htmlspecialchars($_POST['name']);  
    $weight = floatval($_POST['weight']);  
    $height = floatval($_POST['height']);  

    // التحقق من صحة البيانات 
    if ($weight <= 0 || $height <= 0) {
        echo "قيم غير صالحة. الوزن والطول يجب أن يكونا أكبر من الصفر.";
        exit;  // التوقف عن التنفيذ إذا كانت البيانات غير صحيحة
    }

    // حساب 
    $bmi =  $weight /($height * $height) ;

    
    if ($bmi < 18.5) {
        $interpretation = "Underweight";
    } elseif ($bmi < 25) {
        $interpretation = "Normal weight";
    } elseif ($bmi < 30) {
        $interpretation = "Overweight";
    } else {
        $interpretation = "Obesity";
    }

    // حفظ في قاعدة البيانات
    $stmt = $mysqli->prepare("INSERT INTO bmi_records (name, weight, height, bmi, interpretation) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sddds", $name, $weight, $height, $bmi, $interpretation);
    $stmt->execute();
    $stmt->close();

    // عرض النتيجة 
    echo "Hello, $name. Your BMI is " . number_format($bmi, 2) . " ($interpretation).";
    exit;  
} else {
    echo "البيانات غير مكتملة.";
    exit;  
}
?>
