<?php
/** @var $pages */
include_once 'base.php'
?>
<div class="flex-1 py-20 px-14">
    <div class="mb-8">
        <h2 class="text-4xl font-bold">Lapas</h2>
    </div>
    <div class="mb-8">
        <!--https://flowbite.com/docs/components/tables-->
        <div class="overflow-x-auto relative shadow-md">
            <table class="w-full text-sm text-left">
                <thead class="text-xs uppercase bg-gray-100">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Redzams
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Nosaukums
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Saite
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Atslēga
                    </th>
                    <?php if (!isRegularUser()) { ?>
                    <th scope="col" class="py-3 px-6">
                        Darbības
                    </th>
                    <?php } ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($pages as $page) { ?>
                <tr class="bg-white border-b">
                    <th scope="row" class="py-4 px-6 font-medium">
                        <!--https://flowbite.com/docs/forms/checkbox-->
                        <label>
                            <input type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300"
                                <?php if ($page['is_visible'] === 1) { echo 'checked'; } ?> disabled>
                        </label>
                    </th>
                    <td class="py-4 px-6">
                        <?= $page['name']?>
                    </td>
                    <td class="py-4 px-6">
                        <?= $page['link']?>
                    </td>
                    <td class="py-4 px-6">
                        <?= $page['key']?>
                    </td>
                    <?php if (!isRegularUser()) { ?>
                    <td class="py-4 px-6">
                        <a href="<?= url('showEditPage', $page['id']) ?>" class="font-medium text-blue-700 hover:underline">rediģēt</a><span>,</span>
                        <form action="<?= url('deletePage', $page['id']) ?>" method="post">
                            <button type="submit" class="font-medium text-red-700 hover:underline">dzēst</button>
                        </form>
                    </td>
                    <?php } ?>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div>
        <?php if (!isRegularUser()) { ?>
        <!--https://flowbite.com/docs/components/buttons-->
        <a href="<?= url('showCreatePage') ?>" class="bg-blue-600 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-5">
            Pievienot
        </a>
        <?php } ?>
    </div>
</div>