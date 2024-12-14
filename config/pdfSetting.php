<?php

return [
    // This number will determine if to use job to create the pdf
    // If mails are greater than or equal to this number then job will be done using queue
    'number_of_mails_to_use_job' => env('NUMBER_OF_MAILS_TO_USE_JOB', 100)
];
