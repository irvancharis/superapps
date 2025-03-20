<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- MODIFIKASI SEPTIAN SUPAYA SUPPORT ZROK (URL TUNNEL) -->
    <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->
    <title>Login</title>
    <script src="<?php echo base_url('assets/css/login.js'); ?>"></script>
    <style>
        body {
            background: linear-gradient(270deg, #1a1a2e, #16213e, #0f3460, #53354a);
            background-size: 400% 400%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            animation: gradientAnimation 10s ease infinite;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>
</head>
<body>
    <form class="w-full max-w-md p-6 text-white" id="loginForm" action="<?php echo base_url('login/'); ?>ceklogin" method="POST" >
        <h2 class="text-4xl font-bold text-center">Login</h2>
        <div class="mt-6">
            <label class="block text-lg">Email</label>
            <input type="email" name="username" class="w-full p-3 mt-2 border border-white bg-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-white placeholder-white" placeholder="" required autofocus>
        </div>
        <div class="mt-4">
            <label class="block text-lg">Password</label>
            <input type="password" name="password" class="w-full p-3 mt-2 border border-white bg-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-white placeholder-white" placeholder="" required>
        </div>
        <button type="submit" class="w-full px-4 py-3 mt-6 text-lg font-semibold bg-white text-gray-800 rounded-lg hover:bg-gray-300 transition duration-300">Login</button>
    </form>

</body>
</html>