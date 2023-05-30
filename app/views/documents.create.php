<?php

/** @var $document */

include_once 'base.php';
$isEditing = isset($document);

?>
<div class="flex-1 py-20 px-14">
    <div class="mb-8">
        <h2 class="text-4xl font-bold"><?php if ($isEditing) {
                echo "Rediģēt " . $document['name'];
            } else {
                echo "Izveidot jaunu dokumentu";
            } ?></h2>
    </div>
    <div>
        <form class="max-w-lg" method="post" action="<?php if ($isEditing) {
            echo url('editDocument', $document['id']);
        } else {
            echo url('createDocument');
        } ?>" enctype="multipart/form-data">
            <div class="flex flex-wrap -mx-3 mb-2">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="language-name">
                        Dokumenta nosaukums
                    </label>
                    <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                           <?php if (isAdminUser() && $isEditing) {echo 'disabled';} ?> name="name" id="language-name" type="text" value="<?php if ($isEditing) {
                        echo $document['name'];
                    } ?>">
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6 mt-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="date-pick-valid-till">
                        Derīgs līdz
                    </label>
                    <input <?php if (isAdminUser() && $isEditing) {echo 'disabled';} ?> name="validTill" type="date" id="date-pick-valid-till" value="<?php if ($isEditing) { echo $document['valid_till']; } ?>"/>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="component-code">
                        Saturs
                    </label>
                    <textarea id="component-code" <?php if (isAdminUser() && $isEditing) {echo 'disabled';} ?> rows="4"
                              class="block p-2.5 w-full text-sm text-gray-900 bg-gray-100 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                              name="content"><?php if ($isEditing) {
                            echo $document['content'];
                        } ?></textarea>
                </div>
                <div class="flex items-center mt-5">
                    <?php if (isAdminUser() && $isEditing) { ?>
                        <div class="ml-3">
                            <a class="bg-blue-600 text-white py-3 px-4 rounded focus:outline-none focus:shadow-outline mr-5"
                               href="<?= url('showChangeRequest', $document['id']) ?>">Pieprasīt izmaiņas</a>
                            <button name="accept"
                                    class="bg-green-600 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-5"
                                    type="submit">Apstiprināt
                            </button>
                            <a class="inline-block align-baseline text-sm text-blue-600 hover:text-blue-800"
                               href="<?= url('documentsIndex') ?>">
                                Atgriezties
                            </a>
                        </div>
                    <?php } else { ?>
                        <div>
                            <button name="save"
                                    class="bg-blue-600 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-5"
                                    type="submit">
                                <?php if ($isEditing) {
                                    echo "Rediģēt";
                                } else {
                                    echo "Saglabāt";
                                } ?>
                            </button>
                            <a class="inline-block align-baseline text-sm text-blue-600 hover:text-blue-800"
                               href="<?= url('documentsIndex') ?>">
                                Atgriezties
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </form>
    </div>
</div>