<?php

class SettingsController
{
    /**
     * @throws Exception
     */
    public function index()
    {
        $settings = SettingsRepository::get();
        renderWithVariables('settings.index.php', ['settings' => $settings]);
    }

    /**
     * @throws Exception
     */
    public function edit()
    {
        $settings = SettingsRepository::get();

        if (empty($settings)) {
            SettingsRepository::create(SettingsRepository::HEADER_CONTENT_KEY, $_POST['headerContent']);
        } else {
            SettingsRepository::edit(SettingsRepository::HEADER_CONTENT_KEY, $_POST['headerContent']);
        }

        header('Location: ' . url('settingsIndex'));
    }
}