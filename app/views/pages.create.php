<?php
/** @var $page */
include_once 'base.php';
$isEditing = isset($page);
?>
<div class="flex-1 py-20 px-14">
    <div class="mb-8">
        <h2 class="text-4xl font-bold"><?php if ($isEditing) {echo "Rediģēt " . $page['name'];} else {echo "Izveidot jaunu lapu"; } ?></h2>
    </div>
    <div>
        <!--https://v1.tailwindcss.com/components/forms-->
        <form class="max-w-lg" method="post" action="<?php if ($isEditing) { echo url('editPage', $page['id']);} else {echo url('createPage');}  ?>">
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="page-name">
                        Nosaukums
                    </label>
                    <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="name" id="page-name" type="text" value="<?php if ($isEditing) { echo $page['name'];} ?>">
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-2">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="page-link">
                        Saite
                    </label>
                    <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="link" id="page-link" type="text" value="<?php if ($isEditing) { echo $page['link'];} ?>">
                </div>
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="page-key">
                        Atslēga
                    </label>
                    <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="key" id="page-key" type="text" value="<?php if ($isEditing) { echo $page['key'];} ?>">
                </div>
            </div>
            <?php if ($isEditing) { ?>
            <div class="flex flex-wrap -mx-3 mt-6">
                <div class="w-full px-3">
                    <label class="md:w-2/3 block text-gray-500 font-bold">
                        <input name="isVisible" class="mr-2 leading-tight" type="checkbox" <?php if ($page['is_visible'] === 1) { echo 'checked'; } ?>>
                        <span class="text-sm">Redzams</span>
                    </label>
                </div>
            </div>
            <?php } ?>
            <div class="flex items-center justify-between">
                <div class="flex items-center mt-5">
                    <button class="bg-blue-600 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-5" type="submit">
                        <?php if ($isEditing) {echo "Rediģēt";} else {echo "Saglabāt"; } ?>
                    </button>
                    <a class="inline-block align-baseline text-sm text-blue-600 hover:text-blue-800" href="<?= url('pagesIndex') ?>">
                        Atgriezties
                    </a>
                </div>
                <?php if ($isEditing) { ?>
                <div>
                    <a href="<?= url('pageComponentsIndex', $page['id']) ?>" class="bg-green-600 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Apskatīt elementus
                    </a>
                </div>
                <?php } ?>
            </div>
        </form>
    </div>
</div>