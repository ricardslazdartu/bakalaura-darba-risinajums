<?php
/** @var $resources */
include_once 'base.php'
?>
<div class="flex-1 py-20 px-14">
    <div class="mb-8">
        <h2 class="text-4xl font-bold">Resursi</h2>
    </div>
    <div class="mb-8">
        <div class="mb-8">
            <?php if (!isRegularUser()) { ?>
            <form action="<?= url('searchFiles') ?>" method="post">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="search">
                    Meklēt failus pēc atslēgvārdiem
                </label>
                <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="search" id="search" type="text" value="">
                <button type="submit" class="bg-green-600 text-white py-1 px-4 rounded focus:outline-none focus:shadow-outline mt-5">
                    Meklēt
                </button>
            </form>
            <?php } ?>
        </div>
        <div class="mb-4 mt-8">
            <h2 class="text-2xl font-bold">Kolekcijas</h2>
        </div>
        <div class="overflow-x-auto relative shadow-md">
            <table class="w-full text-sm text-left">
                <thead class="text-xs uppercase bg-gray-100">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Kolekcijas nosaukums
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Failu skaits
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Kopējais izmērs
                    </th>
                    <?php if (!isRegularUser()) { ?>
                    <th scope="col" class="py-3 px-6">
                        Darbības
                    </th>
                    <?php } ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($resources as $resource) { ?>
                    <tr>
                        <td class="py-4 px-6">
                            <?= $resource['name'] ?>
                        </td>
                        <td class="py-4 px-6">
                            <?= $resource['count'] ?>
                        </td>
                        <td class="py-4 px-6">
                            <?= $resource['totalSize'] ?>
                        </td>
                        <?php if (!isRegularUser()) { ?>
                        <td class="py-4 px-6">
                            <a href="<?= url('showEditResource', $resource['id']) ?>"
                               class="font-medium text-blue-700 hover:underline">rediģēt</a><span>,</span>
                            <form action="<?= url('deleteResource', $resource['id']) ?>" method="post">
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
        <a href="<?= url('showCreateResource') ?>"
           class="bg-blue-600 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-5">
            Pievienot
        </a>
        <?php } ?>
    </div>
</div>