<?php include('header.php'); ?>
<?php include('navbar.php'); ?>


<?php if (isset($entity)) {  ?>
    <section class="bg-white dark:bg-gray-900 mt-20">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900">Edit familie</h2>
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="surname" class="block mb-2 text-sm font-medium text-gray-900 ">Familie Name</label>
                        <input type="text" name="surname" id="surname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Type familie name" value="<?php echo $entity['surname']; ?>" required="">
                    </div>
                    <div class="w-full">
                        <label for="streetname" class="block mb-2 text-sm font-medium text-gray-900 ">Streetname</label>
                        <input type="text" name="streetname" id="streetname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Streetname" value="<?php echo $entity['streetname']; ?>" required="">
                    </div>

                    <div class="w-full">
                        <label for="house_number" class="block mb-2 text-sm font-medium text-gray-900">Housenumber</label>
                        <input type="text" name="house_number" id="house_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 d" placeholder="Housenumber" value="<?php echo $entity['house_number']; ?>" required="">
                    </div>
                    <div class="w-full">
                        <label for="zip_code" class="block mb-2 text-sm font-medium text-gray-900">Postcode</label>
                        <input type="text" name="zip_code" id="zip_code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Postcode" value="<?php echo $entity['zip_code']; ?>" required="">
                    </div>

                    <div class="w-full">
                        <label for="city" class="block mb-2 text-sm font-medium text-gray-900">City</label>
                        <input type="text" name="city" id="city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="City" value="<?php echo $entity['city']; ?>" required="">
                    </div>
                </div>
                <button type="submit" class="mt-8 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dhover:cursor-pointer">
                    Save changes
                </button>

                <input type="hidden" name="action" id="action" value="save-changes" />
                <input type="hidden" name="country" id="country" value="Nederland" />
            </form>
        </div>
    </section>

<?php } ?>

<?php include('footer.php'); ?>