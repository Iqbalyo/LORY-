<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lory</title>

    @vite('resources/css/app.css')

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: 'Montserrat', sans-serif;
            background:#F5F7FA;
        }

        @keyframes fadeUp {
            from{
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-up {
            animation: fadeUp 0.8s ease forwards;
        }

        .delay {
            animation-delay: 1s;
            opacity: 0;
        }
    </style>
</head>
<body>

<div class="min-h-screen flex flex-col text-center items-center justify-center">

    <h1 class="text-6xl font-semibold text-[#1A2B3E]">
        LORY
    </h1>
    <p class="mt-4 fade-up delay-1 text-gray-500 tracking-wide">Persiapkan dirimu</p>
   

</div>
<script>
    setTimeout(function(){
        window.location.href = "/register";
    }, 1500);
</script>

</body>
</html>