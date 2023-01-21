<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


    <?php

    foreach ($user as $val) {
    ?>

        <div class="max-w-md mx-auto my-10 px-10">
            <div class="shadow rounded p-5">
                <div class="my-5 text-2xl uppercase text-center font-bold">User</div>
                <div class="flex items-center mb-3">
                    <div class="font-bold text-gray-500">Name: </div>
                    <div class="text-lg capitalize ml-2 "><?= $val->name; ?></div>
                </div>
                <div class="flex items-center mb-3">
                    <div class="font-bold text-gray-500">Email: </div>
                    <div class="text-lg ml-2 "><?= $val->email; ?></div>
                </div>
                <div class="flex items-center mb-3">
                    <div class="font-bold text-gray-500">Phone: </div>
                    <div class="text-lg ml-2 "><?= $val->phone; ?></div>
                </div>
                <div class="text-center mt-10 block">
                    <a href="/" class="bg-green-500 text-black p-2.5 rounded">Home</a>
                </div>
            </div>
        </div>

    <?php
    }
    ?>


    <script src="/assets/js/tailwindcss.js"></script>

</body>

</html>