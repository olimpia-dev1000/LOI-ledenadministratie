<?php if (isset($_SESSION['msg'])) : ?>
    <div class="mx-auto fixed inset-x-0 top-4  w-1/3  rounded bg-<?php echo $_SESSION['msg_color']; ?>-100 border border-<?php echo $_SESSION['msg_color']; ?>-400 text-center text-<?php echo $_SESSION['msg_color']; ?>-700 px-4 py-3 z-10" role="alert">
        <strong class="font-bold"><?php echo $_SESSION['msg_header'] ?></strong>
        <span class="block sm:inline"><?php echo $_SESSION['msg'] ?></span>
    </div>
<?php endif ?>
</body>

</html>