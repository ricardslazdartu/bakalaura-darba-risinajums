<?php
/** @var $acceptedDocuments */
/** @var $documentsWaiting */
/** @var $documentsToChange */
include_once 'base.php'
?>
<div class="flex-1 py-20 px-14">
    <div class="mb-8">
        <h2 class="text-4xl font-bold">Dokumenti</h2>
    </div>
    <?php if (!isRegularUser()) { ?>
    <div>
        <a href="<?= url('showCreateDocument') ?>"
           class="bg-blue-600 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-5">
            Pievienot
        </a>
    </div>
    <?php } ?>
    <div class="mb-4 mt-8">
        <h2 class="text-2xl font-bold mb-6">Apstiprinātie</h2>
        <div class="grid gap-2 md:grid-cols-3">
            <?php foreach ($acceptedDocuments as $documentAccepted) {
            ?>
            <div class="bg-white dark:bg-slate-900 rounded-lg px-6 py-8 ring-1 ring-slate-900/5 shadow-xl">
                <h3 class="text-slate-900 dark:text-white text-base font-medium tracking-tight mb-4"><?= $documentAccepted['name'] ?></h3>
                <p class="first-letter:text-5xl first-letter:font-bold first-letter:text-slate-900 first-letter:mr-3 first-letter:float-left">
                    <?= $documentAccepted['content'] ?>
                </p>
                <p class="mt-2 font-small text-green-700 mb-5">Derīgs līdz <?= $documentAccepted['valid_till'] ?></p>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="mb-4 mt-8">
        <h2 class="text-2xl font-bold">Gaida apstiprinājumu</h2>
    </div>
    <div class="grid gap-2 md:grid-cols-3">
        <?php foreach ($documentsWaiting as $documentWaiting) {
            ?>
            <div class="bg-white dark:bg-slate-900 rounded-lg px-6 py-6 ring-1 ring-slate-900/5 shadow-xl">
                <h3 class="text-slate-900 dark:text-white text-base font-medium tracking-tight"><?= $documentWaiting['name'] ?></h3>
                <p class="mt-2 mb-4 font-small text-blue-700">Iesniegts <?= $documentWaiting['created_at'] ?></p>
                <?php if (!isRegularUser()) { ?>
                <div class="flex items-center justify-between">
                    <div>
                        <a href="<?= url('showEditDocument', $documentWaiting['id']) ?>"
                           class="bg-blue-600 text-white py-1 px-4 rounded focus:outline-none focus:shadow-outline">
                            Apskatīt
                        </a>
                    </div>
                    <div>
                        <form action="<?= url('deleteDocument', $documentWaiting['id']) ?>" method="post">
                            <button type="submit"
                                    class="bg-red-600 text-white py-1 px-4 rounded focus:outline-none focus:shadow-outline">
                                Dzēst
                            </button>
                        </form>
                    </div>
                </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
    <div class="mb-4 mt-8">
        <h2 class="text-2xl font-bold">Nepieciešamas izmaiņas</h2>
    </div>
    <div class="grid gap-2 md:grid-cols-3">
        <?php foreach ($documentsToChange as $documentToChange) {
            ?>
            <div class="bg-white dark:bg-slate-900 rounded-lg px-6 py-6 ring-1 ring-slate-900/5 shadow-xl">
                <h3 class="text-slate-900 dark:text-white text-base font-medium tracking-tight"><?= $documentToChange['name'] ?></h3>
                <p class="mt-2 mb-4 font-small text-blue-700">Iesniegts <?= $documentToChange['created_at'] ?></p>
                <?php if (!isRegularUser()) { ?>
                <div class="flex items-center justify-between">
                    <div>
                        <a href="<?= url('showChangeRequests', $documentToChange['id']) ?>"
                           class="bg-blue-600 text-white py-1 px-4 rounded focus:outline-none focus:shadow-outline">
                            Apskatīt
                        </a>
                    </div>
                    <div>
                        <form action="<?= url('deleteDocument', $documentToChange['id']) ?>" method="post">
                            <button type="submit"
                                    class="bg-red-600 text-white py-1 px-4 rounded focus:outline-none focus:shadow-outline">
                                Dzēst
                            </button>
                        </form>
                    </div>
                </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>