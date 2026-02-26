<?php

namespace App\Enum;

use App\Interfaces\EnumWithCaption;

enum PopUpContent: string implements EnumWithCaption
{
    case REG_SUCCESS               = 'reg_success';
    case UPDATE_SUCCESS            = 'update_success';
    case PASSWORD_UPDATE_SUCCESS   = 'password_update_success';
    case CATEGORY_CREATE_SUCCESS   = 'category_create_success';
    case CATEGORY_UPDATE_SUCCESS   = 'category_update_success';
    case COLOR_CREATE_SUCCESS      = 'color_create_success';
    case COLOR_UPDATE_SUCCESS      = 'color_update_success';
    case PATIENT_CREATE_SUCCESS    = 'patient_create_success';
    case PATIENT_UPDATE_SUCCESS    = 'patient_update_success';
    case PRODUCT_CREATE_SUCCESS    = 'product_create_success';
    case PRODUCT_UPDATE_SUCCESS    = 'product_update_success';
    case IMAGE_DELETE_SUCCESS      = 'image_delete_success';
    case IMAGE_ADD_SUCCESS         = 'image_add_success';
    case PROPOSAL_PRICE_CREATE     = 'proposal_price_create';
    case PROPOSAL_PROTHESIS_CREATE = 'proposal_prothesis_create';
    case ORDER_CREATE              = 'order_create';
    case ORDER_DOWNLOAD            = 'order_download';
    case ORDER_RESENT              = 'order_reset';


    public function caption(): string
    {
        return match ($this) {
            self::REG_SUCCESS               => 'Пользователь успешно создан',
            self::UPDATE_SUCCESS            => 'Пользователь успешно обновлен',
            self::PASSWORD_UPDATE_SUCCESS   => 'Пароль успешно обновлен',
            self::CATEGORY_CREATE_SUCCESS   => 'Категория успешно создана',
            self::CATEGORY_UPDATE_SUCCESS   => 'Категория успешно обновлен',
            self::COLOR_CREATE_SUCCESS      => 'Цвет успешно создан',
            self::COLOR_UPDATE_SUCCESS      => 'Цвет успешно обновлен',
            self::PATIENT_CREATE_SUCCESS    => 'Пациент успешно создан',
            self::PATIENT_UPDATE_SUCCESS    => 'Пациент успешно обновлен',
            self::PRODUCT_CREATE_SUCCESS    => 'Продукт успешно создан',
            self::PRODUCT_UPDATE_SUCCESS    => 'Продукт успешно обновлен',
            self::IMAGE_DELETE_SUCCESS      => 'Фотография успешно удалена',
            self::IMAGE_ADD_SUCCESS         => 'Фотографии успешно добавлены',
            self::PROPOSAL_PRICE_CREATE     => 'Заявка на прайс успешно отправлена',
            self::PROPOSAL_PROTHESIS_CREATE => 'Заявка на протез успешно отправлена',
            self::ORDER_CREATE              => 'Заказ успешно создан',
            self::ORDER_DOWNLOAD            => 'PDF Заказа скачан',
            self::ORDER_RESENT              => 'PDF Заказа отправлен',
        };
    }
}
