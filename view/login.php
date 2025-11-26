<?php
session_start();
// Path model tetap (naik 1 level)
require_once __DIR__ . '/../model/AuthModel.php';

// --- LOGIKA ---
$error_message = '';

// 1. Cek jika sudah login, lempar ke Dashboard di dalam folder admin
if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
    header("Location: admin/dashboard.php"); // Perhatikan path ini
    exit;
}

// 2. Proses Login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $authModel = new AuthModel();
    $user = $authModel->checkLogin($username, $password);

    if ($user) {
        // Set Session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['is_logged_in'] = true;

        // Redirect Sukses: Masuk ke folder admin
        header("Location: admin/dashboard.php"); 
        exit;
    } else {
        $error_message = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Lab MMT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="h-screen w-full flex overflow-hidden bg-white">

    <div class="hidden lg:flex w-1/2 bg-cover bg-center relative items-center justify-center" 
         style="background-image: url('../assets/images/gedung_jti.jpg');"> <div class="absolute inset-0 bg-black/40"></div>
        <img src="../assets/images/mmtLogo.png" alt="Logo Lab MMT" class="w-64 relative z-10 drop-shadow-2xl">
    </div>

    <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
        <div class="w-full max-w-[400px]">
            <div class="text-center mb-8">
                <img src="../assets/images/mmtLogo.png" alt="Logo Lab MMT" class="w-24 mx-auto mb-4 lg:hidden">
                <h1 class="text-2xl font-extrabold text-gray-900">Selamat Datang Kembali</h1>
                <p class="text-gray-500 text-sm mt-1 font-medium">Masuk untuk mengelola konten website</p>
            </div>

            <?php if ($error_message): ?>
                <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl mb-6 text-sm text-center font-medium">
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST" class="space-y-5">
                <div>
                    <label class="block text-sm font-bold text-gray-800 mb-2">Username</label>
                    <input type="text" name="username" placeholder="Username" required
                        class="w-full px-5 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-100 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-800 mb-2">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" placeholder="........." required
                            class="w-full px-5 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-100 outline-none transition-all">
                        <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 px-4 text-gray-400 hover:text-gray-600">
                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="w-full py-3.5 px-4 bg-[#F97316] hover:bg-orange-600 text-white font-bold rounded-xl shadow-lg transition-all transform active:scale-95 text-sm mt-4">
                    Masuk Dashboard
                </button>
                
                <div class="text-center mt-4">
                     <a href="../index.php" class="text-sm text-gray-400 hover:text-orange-500 transition">← Kembali ke Website</a>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        function togglePassword() {
            var x = document.getElementById("password");
            x.type = (x.type === "password") ? "text" : "password";
        }
    </script>
</body>
</html>