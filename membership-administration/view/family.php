<?php include('header.php'); ?>
<?php if (isset($_SESSION['loggedin'])) include('navbar.php'); ?>

<section class="mt-4 pl-72 py-8 pr-4">

    <div class="bg-slate-100 rounded drop-shadow p-4 mb-6">
        <h1 class="text-3xl font-extrabold leading-none tracking-tight text-gray-900">Families overview </h1>
    </div>

    <?php if (isset($entities)) { ?>
        <?php if (count($entities) > 0) { ?>

            <div class="relative overflow-x-auto bg-slate-100 rounded drop-shadow p-6">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">Name</th>
                            <th scope="col" class="px-6 py-3">Streetname</th>
                            <th scope="col" class="px-6 py-3">House number</th>
                            <th scope="col" class="px-6 py-3">Zip code</th>
                            <th scope="col" class="px-6 py-3">City</th>
                            <th scope="col" class="px-6 py-3">Country</th>
                            <th scope="col" class="px-6 py-3">Members</th>
                            <th scope="col" class="px-6 py-3"></th>
                            <th scope="col" class="px-6 py-3"></th>
                            <th scope="col" class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($entities as $entity) : ?>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4"><?php echo $entity['surname']; ?></td>
                                <td class="px-6 py-4"><?php echo $entity['streetname']; ?></td>
                                <td class="px-6 py-4"><?php echo $entity['house_number']; ?></td>
                                <td class="px-6 py-4"><?php echo $entity['zip_code']; ?></td>
                                <td class="px-6 py-4"><?php echo $entity['city']; ?></td>
                                <td class="px-6 py-4"><?php echo $entity['country']; ?></td>
                                <td class="px-6 py-4">
                                    <?php $members = array(); ?>
                                    <?php foreach ($familyMembers as $familyMember) :
                                        if ($familyMember['family_id'] == $entity['family_id']) {
                                            echo $familyMember['first_name'] . ' ';
                                            array_push($members, 1);
                                        }
                                    endforeach; ?>
                                </td>
                                <td class="px-6 py-4 text-right">

                                    <?php if (count($members) >= 1) { ?>

                                        <form class="nav" method="post" action="/<?php echo homeDir(); ?>/member">
                                            <input type="submit" name="show-members" id="show-members" class="font-medium text-blue-600 dark:text-red-500 cursor-pointer hover:underline" value="See members" />
                                            <input type="hidden" name="action" id="action" value="show-members" />
                                            <input type="hidden" name="family_id" id="family_id" value="<?php echo $entity['family_id']; ?>" />
                                        </form>
                                    <?php } ?>
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <form class="nav" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                        <input type="submit" name="edit" id="edit" class="font-medium text-blue-600 dark:text-red-500 cursor-pointer hover:underline" value="Edit" />
                                        <input type="hidden" name="action" id="action" value="edit" />
                                        <input type="hidden" name="family_id" id="family_id" value="<?php echo $entity['family_id']; ?>" />
                                    </form>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <form class="nav" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                        <input type="submit" name="delete" id="delete" class="font-medium text-red-600 dark:text-red-500 cursor-pointer hover:underline" value="<?php echo (isset($_SESSION['delete_id']) && $_SESSION['delete_id'] == $entity['family_id']) ? 'PLEASE CONFIRIM' : 'Delete'; ?>" />
                                        <input type="hidden" name="action" id="action" value="delete" />
                                        <?php if (isset($_SESSION['delete_id']) && $_SESSION['delete_id'] == $entity['family_id']) {
                                            echo '<input type="submit" class="font-medium text-grey-600 cursor-pointer hover:underline" name="confirm" id="confirm" value="CANCEL" />';
                                        }
                                        ?>
                                        <input type="hidden" name="family_id" id="family_id" value="<?php echo $entity['family_id']; ?>" />
                                    </form>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php } else {  ?>
            <p>There are no families yet.</p>

        <?php } ?>
        <div class="flex mt-8 md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">

            <form class="nav" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <input type="submit" class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 hover:cursor-pointer" value="Add family" />
                <input type="hidden" name="action" id="action" value="add" />
            </form>

        </div>
</section>
<?php } ?>

<?php include('footer.php'); ?>