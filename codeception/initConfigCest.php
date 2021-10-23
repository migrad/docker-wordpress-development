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
                'language' => '{{ env.wordpressInitialConfigLang }}',
            ),
            '#language-continue');

            $form = array(
                'weblog_title' => '{{ env.wordpressInitialConfigTitle }}',
                'user_login' => '{{ env.wordpressInitialConfigUserName }}',
                'admin_password' => '{{ env.wordpressInitialConfigPassword }}',
                'admin_password2' => '{{ env.wordpressInitialConfigPassword2 }}',
                'admin_email' => '{{ env.wordpressInitialConfigEmail }}',
            );
            $I->submitForm('form#setup', $form, 'Submit');
        }
    }
}
