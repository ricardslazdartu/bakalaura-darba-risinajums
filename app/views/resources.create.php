<?php

/** @var $resource */
/** @var $files */
include_once 'base.php';
$isEditing = isset($resource);
?>
<div class="flex-1 py-20 px-14">
    <div class="mb-8">
        <h2 class="text-4xl font-bold"><?php if ($isEditing) {echo "Rediģēt " . $resource['name'];} else {echo "Izveidot jaunu kolekciju"; } ?></h2>
    </div>
    <div>
        <form class="max-w-lg" method="post" action="<?php if ($isEditing) { echo url('editResource', $resource['id']);} else {echo url('createResource');}  ?>" enctype="multipart/form-data">
            <div class="flex flex-wrap -mx-3 mb-2">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="language-name">
                        Kolekcijas nosaukums
                    </label>
                    <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="name" id="language-name" type="text" value="<?php if ($isEditing) { echo $resource['name'];} ?>">
                </div>
            </div>
            <div class="mb-4 mt-8">
                <h2 class="text-2xl font-bold">Faili</h2>
            </div>
            <?php if ($isEditing) {
                foreach ($files as $index => $file) {
                    $isImg = getimagesize($file['path']) !== false;
                    if ($isImg) {
                        ?>
                        <div class="w-full mt-4">
                            <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"><?= $index + 1 ?>. fails</p>
                            <img src="<?= substr($file['path'], 1) ?>" alt="<?= $file['id'] ?>" width="100" height="100">
                            <input type="hidden" name="fileId" value="<?= $file['id'] ?>">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-3 mb-3" for="keyword-input-<?= $file['id'] ?>">Atslēgvārdi</label>
                            <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="keywords__<?= $file['id'] ?>" id="keyword-input-<?= $file['id'] ?>" type="text" value="<?php if ($isEditing) { echo $file['keywordString'];} ?>">
                            <button type="submit" name="deleteFile" class="mt-2 font-small text-red-700 hover:underline">dzēst failu</button>
                        </div>
                            <?php
                    }
                } ?>
            <?php } else { ?>
                <div class="w-full mt-4">
                    <p class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Augšupielādēt failus</p>
                    <input class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-200 file:text-blue-600 hover:file:bg-blue-100" id="multiple_files" type="file" multiple="multiple" name="resourceFiles[]">
                </div>
            <?php } ?>
            <div class="flex items-center mt-5">
                    <button name="save" class="bg-blue-600 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-5" type="submit">
                        <?php if ($isEditing) {echo "Rediģēt";} else {echo "Saglabāt"; } ?>
                    </button>
                    <a class="inline-block align-baseline text-sm text-blue-600 hover:text-blue-800" href="<?= url('resourcesIndex') ?>">
                        Atgriezties
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>