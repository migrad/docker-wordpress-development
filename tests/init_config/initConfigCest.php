<?php

class initConfigCest
{
    public function _before(Init_configTester $I)
    {
    }

    // tests
    public function initialConfigWordpress(Init_configTester $I)
    {
        if ($I->tryToSeeElement('form#setup')) {
            $I->seeInCurrentUrl('wp-admin/install.php');
            $I->submitForm('form#setup', array(
                'language' => 'es_ES',
            ),
            '#language-continue');

            $form = array(
                'weblog_title' => 'Title',
                'user_login' => 'admin',
                'admin_password' => 'admin.12345',
                'admin_password2' => 'admin.12345',
                'admin_email' => 'migrad@gmail.com',
            );
            $I->submitForm('form#setup', $form, 'Submit');
        }
    }
}
