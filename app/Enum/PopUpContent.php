<?php

namespace App\Enum;

use App\Interfaces\EnumWithCaption;

enum PopUpContent: string implements EnumWithCaption
{
    case REG_SUCCESS                  = 'reg_success';
    case UPDATE_SUCCESS               = 'update_success';
    case PASSWORD_UPDATE_SUCCESS      = 'password_update_success';
    case REG_SUCCESS_INFO             = 'reg_success_info';
    case UPDATE_SUCCESS_INFO          = 'update_success_info';
    case PASSWORD_UPDATE_SUCCESS_INFO = 'password_update_success_info';
    case CATEGORY_CREATE_SUCCESS      = 'category_create_success';
    case CATEGORY_CREATE_SUCCESS_INFO = 'category_create_success_info';
    case CATEGORY_UPDATE_SUCCESS      = 'category_update_success';
    case CATEGORY_UPDATE_SUCCESS_INFO = 'category_update_success_info';
    case COLOR_CREATE_SUCCESS         = 'color_create_success';
    case COLOR_CREATE_SUCCESS_INFO    = 'color_create_success_info';
    case COLOR_UPDATE_SUCCESS         = 'color_update_success';
    case COLOR_UPDATE_SUCCESS_INFO    = 'color_update_success_info';
    case PATIENT_CREATE_SUCCESS      = 'patient_create_success';
    case PATIENT_CREATE_SUCCESS_INFO = 'patient_create_success_info';
    case PATIENT_UPDATE_SUCCESS      = 'patient_update_success';
    case PATIENT_UPDATE_SUCCESS_INFO = 'patient_update_success_info';
    case PRODUCT_CREATE_SUCCESS      = 'product_create_success';
    case PRODUCT_CREATE_SUCCESS_INFO = 'produc_create_success_info';
    case PRODUCT_UPDATE_SUCCESS      = 'product_update_success';
    case PRODUCT_UPDATE_SUCCESS_INFO = 'produc_update_success_info';
    case IMAGE_DELETE_SUCCESS        = 'image_delete_success';
    case IMAGE_DELETE_SUCCESS_INFO   = 'image_delete_success_info';
    case IMAGE_ADD_SUCCESS           = 'image_adde_success';
    case IMAGE_ADD_SUCCESS_INFO      = 'image_add_success_info';
    case PROPOSAL_PRICE_CREATE       = 'proposal_price_create';
    case PROPOSAL_PROTHESIS_CREATE   = 'proposal_prothesis_create';


    public function caption(): string
    {
        return match ($this) {
            self::REG_SUCCESS                  => 'Пользователь создан',
            self::UPDATE_SUCCESS               => 'Пользователь обновлен',
            self::PASSWORD_UPDATE_SUCCESS      => 'Пароль обновлен',
            self::REG_SUCCESS_INFO             => 'Пользователь успешно создан',
            self::UPDATE_SUCCESS_INFO          => 'Пользователь успешно обновлен',
            self::PASSWORD_UPDATE_SUCCESS_INFO => 'Пароль успешно обновлен',
            self::CATEGORY_CREATE_SUCCESS      => 'Категория создана',
            self::CATEGORY_CREATE_SUCCESS_INFO => 'Категория успешно создана',
            self::CATEGORY_UPDATE_SUCCESS      => 'Категория обновлена',
            self::CATEGORY_UPDATE_SUCCESS_INFO => 'Категория успешно обновлен',
            self::COLOR_CREATE_SUCCESS         => 'Цвет создан',
            self::COLOR_CREATE_SUCCESS_INFO    => 'Цвет успешно создан',
            self::COLOR_UPDATE_SUCCESS         => 'Цвет обновлен',
            self::COLOR_UPDATE_SUCCESS_INFO    => 'Цвет успешно обновлен',
            self::PATIENT_CREATE_SUCCESS       => 'Пациент создан',
            self::PATIENT_CREATE_SUCCESS_INFO  => 'Пациент успешно создан',
            self::PATIENT_UPDATE_SUCCESS       => 'Пациент обновлен',
            self::PATIENT_UPDATE_SUCCESS_INFO  => 'Пациент успешно обновлен',
            self::PRODUCT_CREATE_SUCCESS       => 'Продукт создан',
            self::PRODUCT_CREATE_SUCCESS_INFO  => 'Продукт успешно создан',
            self::PRODUCT_UPDATE_SUCCESS       => 'Продукт обновлен',
            self::PRODUCT_UPDATE_SUCCESS_INFO  => 'Продукт успешно обновлен',
            self::IMAGE_DELETE_SUCCESS         => 'Фотография удалена',
            self::IMAGE_DELETE_SUCCESS_INFO    => 'Фотография успешно удалена',
            self::IMAGE_ADD_SUCCESS            => 'Фотографии добавлены',
            self::IMAGE_ADD_SUCCESS_INFO       => 'Фотографии успешно добавлены',
            self::PROPOSAL_PRICE_CREATE        => 'Заявка на прайс успешно отправлена',
            self::PROPOSAL_PROTHESIS_CREATE    => 'Заявка на протез успешно отправлена',
        };
    }
}
