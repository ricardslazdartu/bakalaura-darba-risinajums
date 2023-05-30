<?php
/** @var $componentsData */
include_once 'base.php'
?>
<div class="flex-1 py-20 px-14">
    <div class="mb-8">
        <h2 class="text-4xl font-bold">Elementi</h2>
    </div>
    <div class="mb-8">
        <!--https://flowbite.com/docs/components/tables-->
        <div class="overflow-x-auto relative shadow-md">
            <table class="w-full text-sm text-left">
                <thead class="text-xs uppercase bg-gray-100">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Nosaukums
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Atribūti
                    </th>
                    <?php if (!isRegularUser()) { ?>
                    <th scope="col" class="py-3 px-6">
                        Darbības
                    </th>
                    <?php } ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($componentsData as $data) {
                    $component = $data['component'];

                    if (isset($data['attributes'])) {
                        $attributes = implode(', ', array_map(function ($attribute) { return $attribute['key'];}, $data['attributes']));
                    } else {
                        $attributes = '';
                    }
                    ?>
                    <tr class="bg-white border-b">
                        <td class="py-4 px-6">
                            <?= $component['name']?>
                        </td>
                        <td class="py-4 px-6">
                            <?= $attributes ?>
                        </td>
                        <?php if (!isRegularUser()) { ?>
                        <td class="py-4 px-6">
                            <a href="<?= url('showEditComponent', $component['id']) ?>" class="font-medium text-blue-700 hover:underline">rediģēt</a><span>,</span>
                            <form action="<?= url('deleteComponent', $component['id']) ?>" method="post">
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
        <a href="<?= url('showCreateComponents') ?>" class="bg-blue-600 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-5">
            Pievienot
        </a>
        <?php } ?>
    </div>
</div>
