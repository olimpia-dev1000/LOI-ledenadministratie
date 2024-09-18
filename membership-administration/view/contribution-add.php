<?php include('header.php'); ?>
<?php if (isset($_SESSION['loggedin'])) include('navbar.php'); ?>

<section class="bg-white mt-20">
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">


        <h2 class="mb-4 text-xl font-bold text-gray-900">Add new contribution</h2>

        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">


                <div class="w-full">
                    <label for="financial_year_id" class="block mb-2 text-sm font-medium text-gray-900">Financial Year</label>
                    <select name="financial_year_id" id="financial_year_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>

                        <?php foreach ($financialYears as $financialYear) : ?>
                            <option value="<?= htmlspecialchars($financialYear['financial_year_id']) ?>">
                                <?= htmlspecialchars($financialYear['description']) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>


                <div class="w-full">
                    <label for="member_type_id" class="block mb-2 text-sm font-medium text-gray-900">Member type</label>
                    <select name="member_type_id" id="member_type_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>

                        <?php foreach ($memberTypes as $memberType) : ?>
                            <option value="<?= htmlspecialchars($memberType['member_type_id']) ?>">
                                <?= htmlspecialchars($memberType['description']) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>


                <div class="w-full">
                    <label for="age_min" class="block mb-2 text-sm font-medium text-gray-900">Minimal age</label>
                    <input type="text" name="age_min" id="age_min" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Minimal age" required>
                </div>

                <div class="w-full">
                    <label for="age_min" class="block mb-2 text-sm font-medium text-gray-900">Maximal age</label>
                    <input type="text" name="age_max" id="age_max" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Maximal age" required>
                </div>


                <div class="w-full">
                    <label for="amount" class="block mb-2 text-sm font-medium text-gray-900">Basic amount</label>
                    <input type="number" name="amount" id="amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Basic amount" required>
                </div>

                <div class="w-full">
                    <label for="discount" class="block mb-2 text-sm font-medium text-gray-900">Discount</label>
                    <input type="number" step="0.01" name="discount" id="discount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Discount" required>
                </div>



            </div>
            <button type="submit" name="submit" value="add" class="mt-8 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center hover:cursor-pointer">
                Add contribution
            </button>

            <input type="hidden" name="action" id="action" value="add" />
        </form>

    </div>
</section>


<?php include('footer.php'); ?>