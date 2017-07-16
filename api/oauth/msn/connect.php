<?php
require '../../../common.inc.php';
require 'init.inc.php';
dheader(WRAP_CONSENT_URL.'?wrap_client_id='.WRAP_CLIENT_ID.'&wrap_callback='.urlencode(WRAP_CALLBACK).'&wrap_scope='.urlencode('WL_Profiles.View'));
?>