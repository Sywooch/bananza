<?php

$siteName = $_SERVER ['SERVER_NAME'];

return [
    'siteName' => $siteName,
    'adminEmail' => 'admin@' . $siteName,
    'fromEmail' => 'noanswer@' . $siteName,
];
