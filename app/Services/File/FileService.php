<?php

namespace App\Services\File;

use App\Traits\File\FileUploadTrait;

class FileService
{
    use FileUploadTrait;
    const FILE_RENAME_PREFIX    = "_good_track_";

    const DIR_DEFUALT    = "uploads";
    const DIR_QR   = self::DIR_DEFUALT."/qr_codes";
    const DIR_CATEGORY   = self::DIR_DEFUALT."/categories";
    const DIR_BRAND      = self::DIR_DEFUALT."/brands";
    const DIR_PRODUCTS   = self::DIR_DEFUALT."/products";
    const DIR_PRODUCT_THUMBNAIL  = self::DIR_PRODUCTS."/thumbnails";

    const DIR_ADMIN_LOGO = self::DIR_DEFUALT.'/admin';
    const DIR_ADMIN_STAFF_IMAGE = self::DIR_DEFUALT.'/admin/admin_staff_image';

    const DIR_BLOG_IMAGE = self::DIR_DEFUALT.'/blogs';
    const DIR_PAGE       = self::DIR_DEFUALT.'/page';
    const DIR_USER_IMAGE = self::DIR_DEFUALT.'/user';
    const DIR_CLIENT_IMAGE = self::DIR_DEFUALT.'/client';
    const DIR_PARTNER = self::DIR_DEFUALT.'/partner';
    const DIR_PARTNER_IMAGE = self::DIR_PARTNER.'/photo';
    const DIR_PARTNER_COMPANY_IMAGE = self::DIR_PARTNER.'/company_logo';
    const DIR_MODEL = self::DIR_DEFUALT.'/models';
    const DIR_Feature = self::DIR_DEFUALT.'/features';
    const DIR_Feature_File = self::DIR_DEFUALT.'/features/files';

    const DIR_DISTRIBUTOR = self::DIR_DEFUALT.'/distributor';
    const DIR_DISTRIBUTOR_IMAGE = self::DIR_DISTRIBUTOR.'/photo';
    const DIR_DISTRIBUTOR_COMPANY_IMAGE = self::DIR_DISTRIBUTOR.'/company_logo';
    const DIR_SHOP = self::DIR_DEFUALT.'/shop';


}
