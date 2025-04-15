<?php 
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "breadone";

    $conn = mysqli_connect($host, $user, $pass, $db);

    // Function Data
    function query($query) {
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

        // Fungsi query untuk mendapatkan semua produk
    function getAllProducts() {
        global $conn;
        $sql = "SELECT p.*, c.name_category 
                FROM `bo-product` p
                JOIN `bo-category` c ON p.id_category = c.id_category
                ORDER BY p.id_product DESC";
        $result = $conn->query($sql);
        
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        return $products;
    }

    // Fungsi pencarian produk dengan prepared statement
    function searchProducts($keyword) {
        global $conn;
        $sql = "SELECT p.id_product, p.image_product, p.name_product, p.price_product, c.name_category 
                FROM `bo-product` p
                JOIN `bo-category` c ON p.id_category = c.id_category
                WHERE p.name_product LIKE ? OR c.name_category LIKE ?";
        
        $stmt = $conn->prepare($sql);
        $search_param = "%$keyword%";
        $stmt->bind_param("ss", $search_param, $search_param);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        return $products;
    }

    function ing() {

    }

    // Function Create
    function add($data) {
        global $conn;
        $id_product = htmlspecialchars($data["id_product"]);
        $name_product = htmlspecialchars($data["name_product"]);
        $price_product = htmlspecialchars($data["price_product"]);
        $id_category = htmlspecialchars($data["id_category"]);
        $stock_product = 0;
        $life_product = htmlspecialchars($data["life_product"]);
        
        $image_product = uplImg();
        if(!$image_product) {
            return false;
        }

        $query = "INSERT INTO `bo-product` VALUES ('$id_product', '$name_product', '$price_product', '$image_product', '$id_category', '$$stock_product', '$life_product')";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    // Function Create
    function addIng($data) {
        global $conn;
        $id_ingredient = htmlspecialchars($data["id_ingredient"]);
        $name_ingredient = htmlspecialchars($data["name_ingredient"]);
        $qty_ingredient = htmlspecialchars($data["qty_ingredient"]);
        $unit_ingredient = htmlspecialchars($data["unit_ingredient"]);
        $price_ingredient = htmlspecialchars($data["price_ingredient"]);
        

        $query = "INSERT INTO `bo-ingredient` VALUES ('$id_ingredient', '$name_ingredient', '$qty_ingredient', '$unit_ingredient', '$price_ingredient')";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    // Function upload gambar produk
    function uplImg() {
        $name_image = $_FILES['image_product']['name'];
        $size_image = $_FILES['image_product']['size'];
        $error_image = $_FILES['image_product']['error'];
        $tmp_image = $_FILES['image_product']['tmp_name'];

        // Validasi gambar tidak di uploads 
        if($error_image === 4) {
            echo "<script>
                alert('Masukkan gambar product!');
            </script>";
            return false;
        }

        // Validasi tipe gambar
        $ext_valid_image = ['jpg', 'jpeg', 'png'];
        $ext_image = explode('.', $name_image);
        $ext_image = strtolower(end($ext_image));

        if(!in_array($ext_image, $ext_valid_image)) {
            echo "<script>
                alert('Mohon masukkan gambar dengan tipe gambar jpg/jpeg/png...');
            </script>";
            return false;
        }

        // Validasi ukuran gambar
        if($size_image > 1000000000) {
            echo "<script>
                alert('Ukuran gambar terlalu besar!');
            </script>";
            return false;
        }

        // Validasi jika nama gambar yang di upload sama
        $new_image = uniqid();
        $new_image .= '.';
        $new_image .= $ext_image;
        move_uploaded_file($tmp_image, __DIR__ . '/Images/' . $new_image);

        return $new_image;


    }

    // Function upload gambar customer
    function uplImgCust() {
        $name_image = $_FILES['image_customer']['name'];
        $size_image = $_FILES['image_customer']['size'];
        $error_image = $_FILES['image_customer']['error'];
        $tmp_image = $_FILES['image_customer']['tmp_name'];

        // Validasi gambar tidak di uploads 
        if($error_image === 4) {
            echo "<script>
                alert('Masukkan gambar product!');
            </script>";
            return false;
        }

        // Validasi tipe gambar
        $ext_valid_image = ['jpg', 'jpeg', 'png'];
        $ext_image = explode('.', $name_image);
        $ext_image = strtolower(end($ext_image));

        if(!in_array($ext_image, $ext_valid_image)) {
            echo "<script>
                alert('Mohon masukkan gambar dengan tipe gambar jpg/jpeg/png...');
            </script>";
            return false;
        }

        // Validasi ukuran gambar
        if($size_image > 1000000) {
            echo "<script>
                alert('Ukuran gambar terlalu besar!');
            </script>";
            return false;
        }

        // Validasi jika nama gambar yang di upload sama
        $new_image = uniqid();
        $new_image .= '.';
        $new_image .= $ext_image;
        move_uploaded_file($tmp_image, __DIR__ . '/Images/' . $new_image);

        return $new_image;


    }

    // Function Read 
    function srch($keyword) {
        $query = "SELECT * FROM `bo-product` 
                    WHERE name_product LIKE '%$keyword%' OR
                        price_product LIKE '%$keyword%' OR
                        id_category LIKE '%$keyword%'
                  ";

        return query($query);
    }

    // Function Update 
    function updt($data) {
        global $conn;

        $id_product = htmlspecialchars($data["old_id"]);
        $name_product = htmlspecialchars($data["name_product"]);
        $description_product = htmlspecialchars($data["description_product"]);
        $price_product = htmlspecialchars($data["price_product"]);
        $id_category = htmlspecialchars($data["id_category"]);
        $old_image = htmlspecialchars($data["old_image"]);

        // Validasi pengubahan gambar
        if ($_FILES['image_product']['error'] === 4) {
            $image_product = $old_image;
        } else { 
            $image_product = uplImg();
        }

        $query = "UPDATE `bo-product` SET
                    name_product = '$name_product',
                    description_product = '$description_product',
                    price_product = '$price_product',
                    image_product = '$image_product',
                    id_category = '$id_category'
                WHERE id_product = '$id_product'
                ";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }  
    
    // Function Update Bahan 
    function updtIng($data) {
        global $conn;

        $id_ingredient = htmlspecialchars($data["old_id"]);
        $name_ingredient = htmlspecialchars($data["name_ingredient"]);
        $qty_ingredient = htmlspecialchars($data["qty_ingredient"]);
        $price_ingredient = htmlspecialchars($data["price_ingredient"]);
        $unit_ingredient = htmlspecialchars($data["unit_ingredient"]);

        $query = "UPDATE `bo-ingredient` SET
                    name_ingredient = '$name_ingredient',
                    qty_ingredient = '$qty_ingredient',
                    price_ingredient = '$price_ingredient',
                    unit_ingredient = '$unit_ingredient'
                WHERE id_ingredient = '$id_ingredient'
                ";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    // Function Delete
    function del($id) {
        global $conn;
        mysqli_query($conn,"DELETE FROM `bo-product` WHERE id_product = '$id'");
        return mysqli_affected_rows($conn);
    }

    // Function Delete Bahan
    function delIng($id) {
        global $conn;
        mysqli_query($conn,"DELETE FROM `bo-ingredient` WHERE id_ingredient = '$id'");
        return mysqli_affected_rows($conn);
    }

    //Function Delete Keranjang
    function delCart($id) {
        global $conn;
        mysqli_query($conn,"DELETE FROM `bo-cart` WHERE id_cart = '$id'");
        return mysqli_affected_rows($conn);
    }

    // Function Registrasi

    function reg($data) {
        global $conn;

        $name_customer = strtolower(stripslashes($data["name_customer"]));
        $password_customer = mysqli_real_escape_string($conn,$data["password_customer"]);
        $password_confirm = mysqli_real_escape_string($conn,$data["password_confirm"]);

        // Validasi gambar customer
        if ($_FILES["image_customer"]["error"] === 4) {
            $image_customer = "default.jpg"; // Gambar default
        } else {
            $image_customer = uplImgCust();
            if (!$image_customer) {
                return false;
            }
        }

        // Validasi password
        if ($password_customer !== $password_confirm) {
            echo "<script>
                    alert('Konfirmasi password tidak sesuai');
                 </script>";
            return false;
        }

        // Validasi exist customer
        $validate_customer = mysqli_query( $conn,"SELECT name_customer FROM `bo-customer` WHERE name_customer = '$name_customer'");

        if(mysqli_fetch_assoc( $validate_customer )) {
            echo "<script>
                    alert('Username sudah terdaftar');
                 </script>";
            return false;
        }
        
        // Enkripsi password
        $password_customer = password_hash($password_customer, PASSWORD_DEFAULT);
    
        mysqli_query($conn, "INSERT INTO `bo-customer` VALUES('', '$name_customer', '$password_customer', '$image_customer')");

        // Validasi registrasi berhasil
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>
                    alert('Berhasil registrasi');
                    document.location.href = 'login.php'; // Redirect ke halaman login
                 </script>";
            exit;
        } else {
            echo "<script>
                    alert('Registrasi gagal, silakan coba lagi');
                 </script>";
            return false;
        }
    }

    function execute($query) {
        global $conn; // Menggunakan koneksi global
        $result = mysqli_query($conn, $query);
    
        if (!$result) {
            die("Query gagal: " . mysqli_error($conn)); // Debugging error
        }
    
        return $result; // Mengembalikan hasil query
    }

    // Function untuk mencari kategori 
    function getAllCategories() {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM `bo-category` ORDER BY id_category ASC");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    function searchCategories($keyword) {
        global $conn;
        $stmt = $conn->prepare("
            SELECT * FROM `bo-category` 
            WHERE name_category LIKE ? 
            ORDER BY id_category ASC
        ");
        $search = "%$keyword%";
        $stmt->bind_param("s", $search);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    
    // FUnctio to get all ingridient
    function getAllIngredient() {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM `bo-ingredient` ORDER BY id_ingredient ASC");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    function searchIngredient($keyword) {
        global $conn;
        $stmt = $conn->prepare("
        SELECT * FROM `bo-ingredient` 
        WHERE name_ingredient LIKE ? 
        ORDER BY id_ingredient ASC
        ");
        $search = "%$keyword%";
        $stmt->bind_param("s", $search);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Function to get report-expense

    function getAllExpense() {
        global $conn;
        return mysqli_query($conn, "SELECT * FROM `bo-income` ORDER BY date_income DESC");
    }
    
    function searchExpense($keyword) {
        global $conn;
        return mysqli_query($conn, "SELECT * FROM `bo-income` WHERE invoice LIKE '%$keyword%' ORDER BY date_income DESC");
    }
       

    function filterExpenseByDate($start, $end) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM `bo-income` WHERE date_income BETWEEN ? AND ?");
        $stmt->bind_param("ss", $start, $end);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
?>