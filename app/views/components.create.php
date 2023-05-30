<?php
/** @var $component */
include_once 'base.php';
$isEditing = isset($component);
?>
<div class="flex-1 py-20 px-14">
    <div class="mb-8">
        <h2 class="text-4xl font-bold"><?php if ($isEditing) {echo "Rediģēt " . $component['name'];} else {echo "Izveidot jaunu elementu"; } ?></h2>
    </div>
    <div>
        <!--https://v1.tailwindcss.com/components/forms-->
        <form class="max-w-lg" method="post" action="<?php if ($isEditing) { echo url('editComponent', $component['id']);} else {echo url('createComponent');}  ?>">
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="component-name">
                        Nosaukums
                    </label>
                    <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="name" id="component-name" type="text" value="<?php if ($isEditing) { echo $component['name'];} ?>">
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="component-code">
                        Saturs
                    </label>
                    <textarea id="component-code" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-100 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="content"><?php if ($isEditing) { echo $component['content'];} ?></textarea>
                    <p id="helper-text-explanation" class="mt-2 text-xs text-gray-500 dark:text-gray-400">Lai pievienotu saturam atribūtus, tie ir jānorāda šādā formātā: <span class="inline bg-sky-100 font-bold text-sm text-slate-900 font-mono rounded dark:bg-slate-600 dark:text-slate-200">%%atribūts_piemērs</span>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center mt-5">
                    <button class="bg-blue-600 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-5" type="submit">
                        <?php if ($isEditing) {echo "Rediģēt";} else {echo "Saglabāt"; } ?>
                    </button>
                    <a class="inline-block align-baseline text-sm text-blue-600 hover:text-blue-800" href="<?= url('componentsIndex') ?>">
                        Atgriezties
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>