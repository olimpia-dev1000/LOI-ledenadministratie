<?php include('header.php'); ?>
<?php if (isset($_SESSION['loggedin'])) include('navbar.php'); ?>


<section class="mt-4 pl-72 py-8 pr-4 h-screen">

    <div class="">
        <h1 class="mb-8 text-3xl font-extrabold leading-none tracking-tight text-gray-900">Hello, <?php echo ucfirst($_SESSION['username']) ?> </h1>
        <p class="mb-8">Below you can see the total contribution that is due for the year. </p>
    </div>

    <div class="w-full bg-slate-100 rounded drop-shadow p-6">
        <form method="POST" action="" id="yearForm">
            <div>
                <label for="financial_year" class="text-sm font-medium text-gray-900">Financial Year</label>
                <select name="financial_year" id="financial_year" onchange="this.form.submit()" class="bg-gray-50 mt-4 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                    <?php foreach ($financialYears as $financialYear) : ?>
                        <option value="<?= htmlspecialchars($financialYear['financial_year_id'] . '|' . $financialYear['description']) ?>" <?= (isset($_SESSION['financial_year_description']) && $_SESSION['financial_year_description'] == $financialYear['description']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($financialYear['description']) ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            <noscript><input type="submit" value="Submit"></noscript>
        </form>

        <p class="mt-4">Total contribution in the given year: <span class="font-bold text-blue-700"><?php echo $data['formatted_total_contribution']; ?><span></p>

    </div>
    <?php if (isset($data)) { ?>
        <?php if (count($data) > 0) { ?>

            <div class="w-full relative overflow-x-auto mt-10 bg-slate-100 rounded drop-shadow p-6">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dzark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">First Name</th>
                            <th scope="col" class="px-6 py-3">Age</th>
                            <th scope="col" class="px-6 py-3">Contribution</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($data['families_array'] as $family) : ?>
                            <?php foreach ($data['members'] as $entity) : ?>
                                <?php if ($family['family_id'] == $entity['family_id']) { ?>
                                    <tr class="bg-white border-b">
                                        <td class="px-6 py-4"><?php echo $entity['first_name']; ?></td>
                                        <td class="px-6 py-4"><?php echo $entity['age']; ?></td>
                                        <td class="px-6 py-4"><?php echo  $entity['formatted_contribution']; ?></td>
                                    </tr>
                                <?php } else   ?>
                            <?php endforeach; ?>

                            <tr class="bg-white border-b text-blue-700">
                                <td class="px-6 py-4"><?php echo "Total contribution" ?><span class="font-bold"> <?php echo 'family ' . $family['surname'] ?></span> </td>
                                <td class="px-6 py-4"></td>
                                <td class="px-6 py-4 font-bold"><?php echo $data['families'][$family['family_id']]['formatted_total'] ?? '€ 0'; ?></td>

                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        <?php } ?>
    <?php } else {  ?>
        <p class="mt-10">Choose financial year.</p>

    <?php } ?>




</section>

<?php include('footer.php'); ?>