<?php

namespace App\Enum;

use App\Interfaces\EnumWithCaption;

enum StoragePath: string
{
    case CATEGORY_STORAGE = 'public/category';
    case COLOR_STORAGE    = 'public/color';
    case IMAGE_STORAGE    = 'public/image';
    case PRODUCT_STORAGE  = 'public/product';
    case ITEM_STORAGE     = 'public/item';
    case USER_STORAGE     = 'public/user';
}
