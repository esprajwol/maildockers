<?php

return [
    'emailIds' => explode(',', env('MAIL_EXCEPTION_RECIPIENTS')),
    'subject-exception' => env('ERROR_MAIL_SUBJECT', 'Error Exception'),
    'pdf-testing-email-ids' => env('TESTING_PDF_RECIPIENTS')
];
