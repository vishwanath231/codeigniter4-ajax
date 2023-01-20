<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <div class="text-center text-xl font-bold p-6 bg-[#14213d] text-white tracking-wider">USER MANAGEMENT SYSTEM</div>

    <div class="max-w-xl mx-auto mt-16 mb-5 px-5">
        <div class="my-10 block">
            <a href="/" class="bg-green-500 text-black p-2.5 rounded">Home</a>
        </div>
        <div class="w-full">
            <div class="text-center text-xl font-medium my-3">Update Form</div>
            <div id="errMsg"></div>
            <form action="" method="post" id="form" class="w-full">
                <?php foreach ($user as $val) { ?>

                    <div class="mb-4">
                        <input type="hidden" name="id" value="<?= $val->id; ?>" id="id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="john">
                    </div>
                    <div class="mb-4">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                        <input type="text" name="name" value="<?= $val->name; ?>" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="john">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                        <input type="email" name="email" value="<?= $val->email; ?>" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="exampl@support.com">
                    </div>
                    <div class="mb-4">
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Phone</label>
                        <input type="tel" name="phone" value="<?= $val->phone;  ?>" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="1234567890">
                    </div>

                <?php } ?>
                <button type="submit" class="bg-[#14213d] text-white hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center">Update</button>
            </form>
        </div>
    </div>

    <script src="/assets/js/tailwindcss.js"></script>



    <script>
        const errMsg = document.getElementById('errMsg');
        form.addEventListener('submit', (e) => formHandler(e));

        /**
         * method  POST
         * type    JSON
         * path    /new
         * desc    create new user
         */
        const formHandler = e => {
            e.preventDefault();

            const id = document.getElementById('id');
            const username = document.getElementById('name');
            const email = document.getElementById('email');
            const phone = document.getElementById('phone');

            const data = {
                id: id.value,
                name: username.value,
                email: email.value,
                phone: Number(phone.value)
            }

            fetch('http://localhost:8080/update', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    if (data?.err) {
                        errMsg.innerHTML = `<div class="p-2.5 rounded bg-red-300 text-black text-gray-800 text-center my-2">${data?.err}</div>`
                    }

                    if (data?.suc) {
                        location.href = '/';
                    }
                });
        }
    </script>


</body>

</html>