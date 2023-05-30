<?php

/** @var $document */
/** @var $changeRequests */
include_once 'base.php';
?>
<div class="flex-1 py-20 px-14">
    <div class="mb-8">
        <h2 class="text-4xl font-bold">Nepieciešamie labojumi</h2>
    </div>
    <div>
        <form class="max-w-lg" method="post" action="<?= url('createChangeRequest', $document['id']) ?>" enctype="multipart/form-data">
            <div class="w-full px-3">
                <ul role="list" class="marker:text-sky-400 list-disc pl-5 space-y-3 text-slate-500">
                    <?php foreach ($changeRequests as $changeRequest) { ?>
                        <li><?= $changeRequest['content'] ?></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="flex items-center mt-10">
                <div>
                    <a href="<?= url('showEditDocument', $document['id']) ?>" class="bg-blue-600 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-5">Turpināt</a>
                    <a class="inline-block align-baseline text-sm text-blue-600 hover:text-blue-800"
                       href="<?= url('documentsIndex') ?>">
                        Atgriezties
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>