<?php

/** @var $document */
include_once 'base.php';
?>
<div class="flex-1 py-20 px-14">
    <div class="mb-8">
        <h2 class="text-4xl font-bold">Pieprasīt izmaiņu</h2>
    </div>
    <div>
        <form class="max-w-lg" method="post" action="<?= url('createChangeRequest', $document['id']) ?>" enctype="multipart/form-data">
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="component-code">
                        Ziņojums
                    </label>
                    <textarea id="component-code" rows="4"
                              class="block p-2.5 w-full text-sm text-gray-900 bg-gray-100 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                              name="content"></textarea>
                </div>
                <div class="flex items-center mt-5">
                    <div class="ml-3">
                        <button name="save"
                                class="bg-blue-600 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-5"
                                type="submit">Saglabāt</button>
                        <a class="inline-block align-baseline text-sm text-blue-600 hover:text-blue-800"
                           href="<?= url('showEditDocument', $document['id']) ?>">
                            Atgriezties
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>