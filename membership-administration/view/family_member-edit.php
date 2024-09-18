<?php include('header.php'); ?>
<?php include('navbar.php'); ?>

<?php if (isset($entity)) {  ?>

    <section class="bg-white dark:bg-gray-900 mt-20">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900">Edit member</h2>

            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">

                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="w-full">
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 ">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="Type first name" value="<?php echo $entity['first_name']; ?>" required="">
                    </div>
                    <div class="w-full">
                        <label for="birthday" class="block mb-2 text-sm font-medium text-gray-900 ">Birthday</label>
                        <input type="date" name="birthday" id="birthday" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " placeholder="birthday" value="<?php echo $entity['birthday']; ?>" required="">
                    </div>


                    <div class="w-full">
                        <label for="family_member_type_id" class="block mb-2 text-sm font-medium text-gray-900">Type</label>

                        <select name="family_member_type_id" id="family_member_type_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                            <?php foreach ($familyMemberTypes as $familyMemberType) : ?>
                                <option value="<?= htmlspecialchars($familyMemberType['family_member_type_id']) ?>"
                                    <?= ($familyMemberType['family_member_type_id'] == $entity['family_member_type_id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($familyMemberType['description']) ?>
                                </option>
                            <?php endforeach ?>
                        </select>


                    </div>
                    <div class="w-full">
                        <label for="member_type_id" class="block mb-2 text-sm font-medium text-gray-900">Member Type</label>
                        <select name="member_type_id" id="member_type_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
    <?php foreach ($memberTypes as $memberType) : ?>
        <option value="<?= htmlspecialchars($memberType['member_type_id']) ?>"
            <?= ($memberType['member_type_id'] == $entity['member_type_id']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($memberType['description']) ?>
        </option>
    <?php endforeach ?>
</select>
                    </div>


                    <div class="w-full">
                        <label for="family_id" class="block mb-2 text-sm font-medium text-gray-900">Family</label>
                        <select name="family_id" id="family_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
    <?php foreach ($families as $family) : ?>
        <option value="<?= htmlspecialchars($family['family_id']) ?>"
            <?= ($family['family_id'] == $entity['family_id']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($family['surname']) ?>
        </option>
    <?php endforeach ?>
</select>
                    </div>
                </div>
                <button type="submit" class="mt-8 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dhover:cursor-pointer">
                    Save changes
                </button>

                <input type="hidden" name="action" id="action" value="save-changes" />
            </form>
        </div>
    </section>

<?php } ?>

<?php include('footer.php'); ?>