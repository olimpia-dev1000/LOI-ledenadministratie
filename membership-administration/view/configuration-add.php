<?php include('header.php'); ?>
<?php if (isset($_SESSION['loggedin'])) include('navbar.php'); ?>

<section class="mt-4 pl-72 py-8 pr-4">

    <h1 class="mb-8 text-3xl font-extrabold leading-none tracking-tight text-gray-900">You are in the <span class="text-blue-800">Configuration overview</span>.</h1>
    <!-- Add field -->
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="grid grid-cols-2 mb-8 gap-6 w-3/6 mx-auto">
            <input type="text" name="description" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type" required>
            <button type="submit" name="submit" value="add" class="w-3/6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center hover:cursor-pointer">
                Add <?php echo str_replace('Add', '', $_POST['submit']) ?>
            </button>
        </div>
        <input type="hidden" name="action" id="action" value="add" />
        <input type="hidden" name="options_entity" id="options_entity" value="<?php echo $_SESSION['entity'] ?>" />

    </form>

    <!-- Add field -->

    <div class="grid grid-cols-2 gap-6">
        <?php
        $configSections = [
            ['title' => 'Financial Year', 'data' => $financialYears, 'idField' => 'financial_year_id', 'entity' => 'financial_year'],
            ['title' => 'Member Type', 'data' => $memberTypes, 'idField' => 'member_type_id', 'entity' => 'member_type'],
            ['title' => 'Family Member Type', 'data' => $familyMemberTypes, 'idField' => 'family_member_type_id', 'entity' => 'family_member_type']
        ];

        foreach ($configSections as $section) :
        ?>
            <div class="relative overflow-x-auto bg-slate-100 rounded drop-shadow p-6">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3"><?php echo $section['title']; ?></th>
                            <th scope="col" class="px-6 py-3"></th>
                            <th scope="col" class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($section['data'] as $item) : ?>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4"><?php echo $item['description']; ?></td>
                                <td class="px-6 py-4 text-right">
                                    <?php echo generateForm('edit', $section['idField'], $item[$section['idField']], $section['entity']); ?>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <?php echo generateForm('delete', $section['idField'], $item[$section['idField']], $section['entity']); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="flex mt-8 md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                    <?php echo generateForm('add', '', '',  '', "Add " . strtolower($section['title'])); ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php include('footer.php'); ?>

<?php
function generateForm($action, $idField, $idValue, $entity, $buttonText = null)
{
    $buttonClass = $action === 'add'
        ? "text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center hover:cursor-pointer"
        : "font-medium text-" . ($action === 'edit' ? 'blue' : 'red') . "-600 dark:text-red-500 cursor-pointer hover:underline";

    $buttonText = $buttonText ?? ucfirst($action);

    return "
    <form class='nav' method='post' action='{$_SERVER['REQUEST_URI']}'>
        <input type='submit' name='submit' class='$buttonClass' value='$buttonText' />
        <input type='hidden' name='action' id='action' value='$action' />
        <input type='hidden' name='options_entity' id='options_entity' value='$entity' />
        " . ($idField ? "<input type='hidden' name='configuration_entity_id' id='configuration_entity_id' value='$idValue' />" : "") . "
    </form>";
}
?>