<?php 
    require '../koneksi.php';
    
    session_start();

        if (isset($_POST['submit'])) {
            
            $email= $_POST['email'];
            $password = $_POST['password'];
            
            $sql = "SELECT * FROM member WHERE email='$email'";
            $result = $db->query($sql);

            if ($result->num_rows == 1) {
                $data = $result->fetch_assoc();
                $hashed_password = $data['password'];
            
                // Gunakan password_verify untuk memeriksa kecocokan
                if (password_verify($password, $hashed_password)) {
                    // Password cocok, set session, dll.
                } else {
                    // Password tidak cocok
                }
            } else {
                // Pengguna tidak ditemukan
            }
            $data = $result->fetch_assoc();
            $ketemu = $result->num_rows;
    
            if ($ketemu == 1) {
        
                session_start();
                
                $_SESSION['email'] = $data['email'];
                $_SESSION['password'] = $data['password'];
                $_SESSION['level'] = $data['level'];
                $_SESSION['login'] = true;

                if ($data['level'] == "admin") {
                    $_SESSION['admin'] = $data['id'];
                    header("Location: ../index.php");
                } elseif ($data['level'] == "pustakawan") {
                    $_SESSION['pustakawan'] = $data['id'];
                    header("Location: ../index.php");
                } else {
                    $_SESSION['anggota'] = $data['id'];
                    header("Location: ../index.php");
                }
    
            } else {
    ?>
                <script type="text/javascript">alert("Email dan Password Anda Salah");</script>
    <?php 
            }
        }
    //}
    ?>
    
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="../assets/css/style-login.css">
  <title>PERPUSTAKAAN</title>
</head>
<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="login.php" method="post">
                    <h2>Login</h2>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" name="email" required>
                        <label for="email">Email</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="password" required>
                        <label for="password">Password</label>
                    </div>
                    <div class="forget">
                        <label for=""><input type="checkbox">Remember Me  <a href="#">Forget Password</a></label>
                      
                    </div>
                    <button type="submit" name="submit">Log in</button>
                    <div class="register">
                        <p>Don't have a account <a href="#">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>


