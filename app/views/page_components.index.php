<?php
/** @var $page */
/** @var $pageComponents */
include_once 'base.php'
?>
<div class="flex-1 py-20 px-14">
    <div class="mb-8">
        <h2 class="text-4xl font-bold">Elementi (<?= $page['name'] ?>)</h2>
    </div>
    <div class="mb-8">
        <!--https://flowbite.com/docs/components/tables-->
        <div class="overflow-x-auto relative shadow-md">
            <table class="w-full text-sm text-left">
                <thead class="text-xs uppercase bg-gray-100">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Secība
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Elements
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Darbības
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($pageComponents as $data) {
                    $component = $data['component'];
                    ?>
                    <tr class="bg-white border-b">
                        <td class="py-4 px-6">
                            <?= $data['order'] . '.'?>
                        </td>
                        <td class="py-4 px-6">
                            <?= $component['name']?>
                        </td>
                        <td class="py-4 px-6">
                            <a href="<?= url('showEditPageComponent', $page['id'], $data['id']) ?>" class="font-medium text-blue-700 hover:underline">rediģēt</a><span>,</span>
                            <form action="<?= url('deletePageComponent', $page['id'], $data['id']) ?>" method="post">
                                <button type="submit" class="font-medium text-red-700 hover:underline">dzēst</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div>
        <!--https://flowbite.com/docs/components/buttons-->
        <a href="<?= url('showAddPageComponent', $page['id']) ?>" class="bg-blue-600 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-5">
            Pievienot
        </a>
        <a class="inline-block align-baseline text-sm text-blue-600 hover:text-blue-800" href="<?= url('showEditPage', $page['id']) ?>">
            Atgriezties
        </a>
    </div>
</div>
