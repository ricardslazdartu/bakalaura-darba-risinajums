<?php
/** @var $components */
/** @var $pageComponents */
/** @var $pageId */

include_once 'base.php';
?>
<div class="flex-1 py-20 px-14">
    <div class="mb-8">
        <h2 class="text-4xl font-bold">Pievienot jaunu elementu</h2>
    </div>
    <div>
        <!--https://v1.tailwindcss.com/components/forms-->
        <form class="max-w-lg" method="post" action="<?= url('createPageComponent', $pageId) ?>">
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="component-select">
                        Elements
                    </label>
                    <select name="componentId" id="component-select" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <?php foreach ($components as $component) { ?>
                        <option value="<?= $component['id'] ?>"><?= $component['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="component-select">
                        Pievienot aiz
                    </label>
                    <select name="order" <?php if (empty($pageComponents)) { echo 'disabled';} ?> id="component-select" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <?php foreach ($pageComponents as $pageComponent) { ?>
                            <option value="<?= $pageComponent['order'] ?>"><?= $pageComponent['order'] . '. ' . $pageComponent['component']['name'] ?></option>
                        <?php } ?>
                    </select>
                    <input type="hidden" name="isVisible" value="0">
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center mt-5">
                    <button class="bg-blue-600 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-5" type="submit">
                        Pievienot
                    </button>
                    <a class="inline-block align-baseline text-sm text-blue-600 hover:text-blue-800" href="<?= url('pageComponentsIndex', $pageId) ?>">
                        Atgriezties
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>