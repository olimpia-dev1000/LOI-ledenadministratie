<?php include('header.php'); ?>
<?php include('navbar.php'); ?>

<section class="bg-white mt-20">
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900">Add new family</h2>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                <div class="sm:col-span-2">
                    <label for="surname" class="block mb-2 text-sm font-medium text-gray-900">Family name</label>
                    <input type="text" name="surname" id="surname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type family name" required>
                </div>
                <div class="w-full">
                    <label for="streetname" class="block mb-2 text-sm font-medium text-gray-900">Streetname</label>
                    <input type="text" name="streetname" id="streetname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Streetname" required>
                </div>

                <div class="w-full">
                    <label for="house_number" class="block mb-2 text-sm font-medium text-gray-900">Housenumber</label>
                    <input type="text" name="house_number" id="house_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Housenumber" required>
                </div>
                <div class="w-full">
                    <label for="zip_code" class="block mb-2 text-sm font-medium text-gray-900">Zip code</label>
                    <input type="text" name="zip_code" id="zip_code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Postcode" required>
                </div>
                <div class="w-full">
                    <label for="city" class="block mb-2 text-sm font-medium text-gray-900">City</label>
                    <input type="text" name="city" id="city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="City" required>
                </div>
            </div>
            <button type="submit" name="submit" value="add" class="mt-8 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center hover:cursor-pointer">
                Add family
            </button>

            <input type="hidden" name="action" id="action" value="add" />
            <input type="hidden" name="country" id="country" value="Nederland" />
        </form>
    </div>
</section>


<?php include('footer.php'); ?>