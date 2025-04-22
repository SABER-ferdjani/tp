function validateForm() {
    var name = document.getElementById("name").value;
    var weight = document.getElementById("weight").value;
    var height = document.getElementById("height").value;

    
    if (name == "" || weight == "" || height == "") {
        alert("يرجى ملء جميع الحقول.");
        return false;
    }

    
    if (weight <= 0 || height <= 0) {
        alert("الوزن والطول يجب أن يكونا أكبر من الصفر.");
        return false;
    }

    return true;
}
