<?php
/** @var $pageComponent */
/** @var $attributes */
/** @var $languages */
/** @var $componentAttributes */

$component = $pageComponent['component'];
$isEditing = isset($componentAttributes);

include_once 'base.php';
?>
<div class="flex-1 py-20 px-14">
    <div class="mb-8">
        <h2 class="text-4xl font-bold">Rediģēt <?= $component['name'] ?></h2>
    </div>
    <div>
        <!--https://v1.tailwindcss.com/components/forms-->
        <form class="max-w-lg" method="post"
              action="<?= url('editPageComponent', $pageComponent['page_id'], $pageComponent['id']) ?>">
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="language-select">
                        Valoda
                    </label>
                    <select name="language" id="language-select"
                            class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <?php foreach ($languages as $language) { ?>
                            <option value="<?= $language['id'] ?>"><?= $language['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mt-6">
                <div class="w-full px-3">
                    <label class="md:w-2/3 block text-gray-500 font-bold">
                        <input name="isVisible" class="mr-2 leading-tight"
                               type="checkbox" <?php if ($pageComponent['is_visible'] === 1) {
                            echo 'checked';
                        } ?>>
                        <span class="text-sm">Redzams</span>
                    </label>
                </div>
            </div>
            <?php if ($isEditing && !empty($attributes)) { ?>
                <div class="mb-4 mt-8">
                    <h2 class="text-2xl font-bold">Atribūti</h2>
                </div>
            <?php } ?>
            <?php foreach ($attributes as $attribute) {

                $componentAttributeFiltered = null;
                foreach ($componentAttributes as $componentAttribute) {
                    if ($componentAttribute['attribute_id'] == $attribute['id']) {
                        $componentAttributeFiltered = $componentAttribute;
                    }
                }

                ?>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                               for="<?= $attribute['key'] ?>">
                            <?= $attribute['key'] ?>
                        </label>
                        <textarea id="<?= $attribute['key'] ?>" rows="1"
                                  class="block p-2.5 w-full text-sm text-gray-900 bg-gray-100 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                  name="attribute__<?= $attribute['key'] ?>"><?php if ($isEditing) {
                                      if ($componentAttributeFiltered) {
                                          echo $componentAttributeFiltered['value'];
                                      }
                            } ?></textarea>
                        <input type="hidden" name="attribute_id__<?= $attribute['key'] ?>"
                               value="<?php if ($componentAttributeFiltered) { echo $componentAttributeFiltered['id']; }?>">
                    </div>
                </div>
            <?php } ?>
            <div class="flex items-center justify-between">
                <div class="flex items-center mt-5">
                    <button class="bg-blue-600 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-5"
                            type="submit">
                        Pievienot
                    </button>
                    <a class="inline-block align-baseline text-sm text-blue-600 hover:text-blue-800"
                       href="<?= url('pageComponentsIndex', $pageComponent['page_id']) ?>">
                        Atgriezties
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>