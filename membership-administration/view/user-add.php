<?php include('header.php'); ?>
<?php if (isset($_SESSION['loggedin'])) include('navbar.php'); ?>

<section class="bg-white mt-20">
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">

        <h2 class="mb-4 text-xl font-bold text-gray-900">Add new user</h2>

        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">

                <div class="w-full">
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                    <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type username" required>
                </div>
                <div class="w-full">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                    <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type password" required>
                </div>

                <div class="w-full">
                    <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
                    <select name="role" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                        <option selected>Choose role</option>
                        <option value="admin">Admin</option>
                        <option value="secretaris">Secretaris</option>
                        <option value="penningmeester">Penningmeester</option>

                    </select>
                </div>
            </div>
            <button type="submit" class="mt-8 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center hover:cursor-pointer">
                Add user
            </button>

            <input type="hidden" name="action" id="action" value="add" />
        </form>

    </div>
</section>


<?php include('footer.php'); ?>