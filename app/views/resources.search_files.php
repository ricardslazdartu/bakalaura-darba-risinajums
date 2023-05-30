<?php
/** @var $files */
include_once 'base.php'
?>
<div class="flex-1 py-20 px-14">
    <div class="mb-8">
        <h2 class="text-4xl font-bold">Failu meklēšanas rezultāti</h2>
    </div>
    <div class="mb-8">
        <?php
        foreach ($files as $index => $file) {
            $isImg = getimagesize($file['path']) !== false;
            if ($isImg) {
                ?>
                        <div class="w-full mt-4">
                            <a href="<?= url('showEditResource', $file['resource_id']) ?>">
                            <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"><?= $index + 1 ?>. fails</p>
                            <img src="<?= substr($file['path'], 1) ?>" alt="<?= $file['id'] ?>" width="100" height="100">
                            </a>
                        </div>
                <?php
            }
        } ?>
    </div>
    <div>
        <button type="submit" class="bg-blue-600 text-white py-1 px-4 rounded focus:outline-none focus:shadow-outline mt-5">
            Eksportēt
        </button>
        <button type="submit" class="bg-red-600 text-white py-1 px-4 rounded focus:outline-none focus:shadow-outline mt-5">
            Dzēst
        </button>
    </div>
</div>