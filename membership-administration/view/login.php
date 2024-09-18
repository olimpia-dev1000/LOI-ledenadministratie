<?php include('header.php'); ?>
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-5/6 w-5/6" src="style/logo.svg" alt=" Your Company">
    </div>

    <div class="mt-2 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" method="post" action="/<?php echo homeDir(); ?>/user">
            <div>
                <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
                <div class="mt-1">
                    <input id="username" name="username" type="text" autocomplete="username" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-950 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                </div>
                <div class="mt-1">
                    <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-950 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
                <input type="submit" class="flex w-full justify-center rounded-md bg-blue-950 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-blue-800 hover:cursor-pointer focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-950"></input>

                <input type="hidden" name="action" id="action" class="ms-3 text-zinc-200 cursor-pointer" value="login" />
            </div>
        </form>
    </div>
</div>

<?php if (isset($msgHeader)) : ?>
    <div class="mx-auto fixed inset-x-0 top-4  w-1/5  rounded bg-<?php echo $color; ?>-100 border border-<?php echo $color; ?>-400 text-center text-<?php echo $color; ?>-700 px-4 py-3" role="alert">
        <strong class="font-bold"><?php echo $msgHeader ?></strong>
        <span class="block sm:inline"><?php echo $msg ?></span>
    </div>
<?php endif ?>

<?php include('footer.php'); ?>