<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body hx-ext="ajax-header">


    <div class="text-center text-xl font-bold p-6 bg-[#14213d] text-white tracking-wider">USER MANAGEMENT SYSTEM</div>

    <div class="max-w-screen-lg mx-auto mt-16 mb-5 px-5">
        <div class="flex flex-col md:flex-row">
            <div class="w-full md:w-1/2 md:m-2">
                <div id="errMsg"></div>
                <form action="" method="post" id="form" class="w-full">
                    <div class="mb-4">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                        <input type="text" name="name" value="<?= set_value('name') ?>" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="john">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                        <input type="email" name="email" value="<?= set_value('email') ?>" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="exampl@support.com">
                    </div>
                    <div class="mb-4">
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Phone</label>
                        <input type="tel" name="phone" value="<?= set_value('phone') ?>" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="1234567890">
                    </div>
                    <button type="submit" class="bg-[#14213d] text-white hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center">Submit</button>
                </form>
            </div>

            <div class="relative overflow-auto w-full md:m-2" style="height: 560px;">
                <table class="w-full text-sm text-left text-gray-500" id="myTable">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th class="px-6 py-3">ID</th>
                            <th class="px-6 py-3">NAME</th>
                            <th class="px-6 py-3">EAMIL</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody id="tbody"></tbody>
                </table>
            </div>

        </div>
    </div>


    <script src="/assets/js/tailwindcss.js"></script>




    <script>
        const tbody = document.getElementById('tbody');
        const errMsg = document.getElementById('errMsg');
        const details = document.getElementById('details');
        const form = document.getElementById('form');
        form.addEventListener('submit', (e) => formHandler(e));



        /**
         * method  POST
         * type    JSON
         * path    /new
         * desc    create new user
         */
        const formHandler = e => {
            e.preventDefault();

            const username = document.getElementById('name');
            const email = document.getElementById('email');
            const phone = document.getElementById('phone');

            const data = {
                username: username.value,
                email: email.value,
                phone: phone.value
            }

            fetch('http://localhost:8080/new', {
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
                    } else {

                        getAllUsers()
                        username.value = "";
                        email.value = "";
                        phone.value = "";
                        errMsg.innerHTML = "";
                    }
                });
        }




        /**
         * method  GET
         * type    JSON
         * path    /users
         * desc    get all users
         */

        function getAllUsers() {
            fetch('http://localhost:8080/users')
                .then((res) => res.json())
                .then((data) => {
                    if (data?.users) {

                        const users = data.users;

                        let template = '';

                        users.forEach(val => {
                            template += `
                        <tr>
                            <td class="px-4 py-4">${val.id}</td>
                            <td class="px-4 py-4 font-medium text-gray-900 uppercase">${val.name}</td>
                            <td class="px-4 py-4">${val.email}</td>
                            <td>
                                <a href='/user/${val.id}' class='bg-green-500 rounded p-2.5 text-white'>view</a>
                            </td>
                        </tr>
                    `;
                        });

                        tbody.innerHTML = template;
                    }
                })
                .catch((err) => console.log(err))
        }

        getAllUsers()
    </script>



</body>

</html>