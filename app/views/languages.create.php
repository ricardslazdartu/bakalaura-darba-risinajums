<?php
/** @var $language */
include_once 'base.php';
$isEditing = isset($language);
?>
<div class="flex-1 py-20 px-14">
    <div class="mb-8">
        <h2 class="text-4xl font-bold"><?php if ($isEditing) {echo "Rediģēt " . $language['name'];} else {echo "Izveidot jaunu valodu"; } ?></h2>
    </div>
    <div>
        <!--https://v1.tailwindcss.com/components/forms-->
        <form class="max-w-lg" method="post" action="<?php if ($isEditing) { echo url('editLanguage', $language['id']);} else {echo url('createLanguage');}  ?>">
            <div class="flex flex-wrap -mx-3 mb-2">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="language-name">
                        Nosaukums
                    </label>
                    <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="name" id="language-name" type="text" value="<?php if ($isEditing) { echo $language['name'];} ?>">
                </div>
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="language-key">
                        Atslēga
                    </label>
                    <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="key" id="language-key" type="text" value="<?php if ($isEditing) { echo $language['key'];} ?>">
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center mt-5">
                    <button class="bg-blue-600 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-5" type="submit">
                        <?php if ($isEditing) {echo "Rediģēt";} else {echo "Saglabāt"; } ?>
                    </button>
                    <a class="inline-block align-baseline text-sm text-blue-600 hover:text-blue-800" href="<?= url('languagesIndex') ?>">
                        Atgriezties
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>