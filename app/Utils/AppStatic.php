<?php

namespace App\Utils;

class AppStatic
{
    const ORDER_NUMBER_OF_YEARS = 1;
    
    # User Types
    const TYPE_ADMIN = 'admin';
    const TYPE_ADMIN_STAFF = 'admin_staff';
    const TYPE_PARTNER = 'partner';
    const TYPE_PARTNER_STAFF = 'partner_staff';

    const TYPE_DISTRIBUTOR = 'distributor';
    const TYPE_DISTRIBUTOR_STAFF = 'distributor_staff';
    const TYPE_CUSTOMER = 'customer';
    const TYPE_CLIENT = 'client';
    const TYPE_INDIVIDUAL = 'individual';

    const TYPE_DistrackModel = 'distrackModel';

    public const FETCH_DISTRIBUTOR_MODELS = "distributorModels";

    # HTTP Codes
    const SUCCESS_WITH_DATA = 201;
    CONST NOT_FOUND = 404;
    CONST VALIDATON_ERROR = 400;
    CONST UNAUTHORIZED = 401;
    CONST FORBIDDEN = 403;
    CONST INTERNAL_SERVER_ERROR = 500;
     
    const CASHIER_CURRENCY="usd";
    const CASHIER_LOGGER="daily";
    const CASHIER_PATH="stripe/webhook";

    const PLATFORMS = [
        1 =>"Gmail",
        2 =>"Outlook",
        3 =>"WhatsApp",
        4 =>"OpenAi Advice",
        5 =>"Gemini Advice",
    ];
}
