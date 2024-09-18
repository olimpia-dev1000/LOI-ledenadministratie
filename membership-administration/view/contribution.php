<?php include('header.php'); ?>
<?php if (isset($_SESSION['loggedin'])) include('navbar.php'); ?>

<section class="mt-4 pl-72 py-8 pr-4">

    <?php if (isset($_SESSION['role']) && in_array($_SESSION['role'], ['admin', 'treasurer'])) { ?>

        <div class="bg-slate-100 rounded drop-shadow p-4 mb-6">
            <h1 class="text-3xl font-extrabold leading-none tracking-tight text-gray-900">Contribution overview </h1>
        </div>



        <?php if (isset($entities)) { ?>
            <?php if (count($entities) > 0) { ?>

                <div class="relative overflow-x-auto bg-slate-100 rounded drop-shadow p-6">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Financial Year</th>
                                <th scope="col" class="px-6 py-3">Member Type</th>
                                <th scope="col" class="px-6 py-3">Age min</th>
                                <th scope="col" class="px-6 py-3">Age max</th>
                                <th scope="col" class="px-6 py-3">Basic amount</th>
                                <th scope="col" class="px-6 py-3">Discount</th>
                                <th scope="col" class="px-6 py-3">Contrtibution</th>
                                <th scope="col" class="px-6 py-3"></th>
                                <th scope="col" class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($entities as $entity) : ?>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">
                                        <?php foreach ($financialYears as $financialYear) :
                                            if ($financialYear['financial_year_id'] == $entity['financial_year_id']) {
                                                echo $financialYear['description'];
                                            }
                                        endforeach; ?>
                                    </td>

                                    <td class="px-6 py-4">
                                        <?php foreach ($memberTypes as $memberType) :
                                            if ($memberType['member_type_id'] == $entity['member_type_id']) {
                                                echo $memberType['description'];
                                            }
                                        endforeach; ?>
                                    </td>


                                    <td class="px-6 py-4"><?php echo $entity['age_min']; ?></td>
                                    <td class="px-6 py-4"><?php echo $entity['age_max']; ?></td>
                                    <td class="px-6 py-4"><?php echo ('€ ' . number_format($entity['amount'], 2, ',', '.')); ?></td>
                                    <td class="px-6 py-4"><?php echo ($entity['discount'] * 100) . ' %'; ?></td>
                                    <td class="px-6 py-4"><?php echo ('€ ' . number_format($entity['amount'] * (1 - $entity['discount']), '2', ',', '.')); ?></td>
                                    <td class="px-6 py-4 text-right">
                                        <form class="nav" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                            <input type="submit" name="edit" id="edit" class="font-medium text-blue-600 dark:text-red-500 cursor-pointer hover:underline" value="Edit" />
                                            <input type="hidden" name="action" id="action" value="edit" />
                                            <input type="hidden" name="contribution_id" id="contribution_id" value="<?php echo $entity['contribution_id']; ?>" />
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <form class="nav" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                            <input type="submit" name="delete" id="delete" class="font-medium text-red-600 dark:text-red-500 cursor-pointer hover:underline" value="<?php echo (isset($_SESSION['delete_id']) && $_SESSION['delete_id'] == $entity['contribution_id']) ? 'PLEASE CONFIRIM' : 'Delete'; ?>" />
                                            <?php if (isset($_SESSION['delete_id']) && $_SESSION['delete_id'] == $entity['contribution_id']) {
                                                echo '<input type="submit" class="font-medium text-grey-600 cursor-pointer hover:underline" name="confirm" id="confirm" value="CANCEL" />';
                                            }
                                            ?>
                                            <input type="hidden" name="action" id="action" value="delete" />
                                            <input type="hidden" name="contribution_id" id="contribution_id" value="<?php echo $entity['contribution_id']; ?>" />
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php } else {  ?>
                <p>There are no contribution yet.</p>

            <?php } ?>
            <div class="flex mt-8 md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">

                <form class="nav" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                    <input type="submit" class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 hover:cursor-pointer" value="Add contribution" />
                    <input type="hidden" name="action" id="action" value="add" />
                </form>
            </div>
        <?php } else { ?>
            <div>
                <p>You don't have permissions to view this page.</p>
            </div>
        <?php } ?>
</section>
<?php } ?>
<?php include('footer.php'); ?>