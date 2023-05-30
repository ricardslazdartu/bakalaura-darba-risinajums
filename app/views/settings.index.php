<?php
/** @var $settings */
include_once 'base.php';

$headerContentSettings = null;
$contentCachingSettings = null;

foreach ($settings as $setting) {
    if ($setting['key'] == SettingsRepository::HEADER_CONTENT_KEY) {
        $headerContentSettings = $setting;
    }
}

?>
<div class="flex-1 py-20 px-14">
    <div class="mb-8">
        <h2 class="text-4xl font-bold">Iestatījumi</h2>
    </div>
        <form class="max-w-lg" method="post" action="<?= url('editSettings') ?>">
            <div class="flex flex-wrap -mx-3 mb-2">
                <div class="w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="setting-header">
                        Galvene
                    </label>
                    <textarea id="setting-header" rows="2"
                              class="block p-2.5 w-full text-sm text-gray-900 bg-gray-100 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                              name="headerContent"><?php if ($headerContentSettings) {echo $headerContentSettings['value'];} ?></textarea>
                    <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">Lai pievienotu papildus pakotnes, tās ir jāpievieno <span class="inline bg-sky-100 font-bold text-sm text-slate-900 font-mono rounded dark:bg-slate-600 dark:text-slate-200">&lt;head&gt;</span> elementam
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center mt-5">
                    <button class="bg-blue-600 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-5" type="submit">
                        Saglabāt
                    </button>
                </div>
        </form>
</div>