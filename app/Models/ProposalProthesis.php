<?php

namespace App\Models;

use App\Enum\AgePeriod;
use App\Enum\ProposalStatus;
use App\Enum\ProthesisFunction;
use App\Enum\ProthesisLevel;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property string $email
 * @property string $phone
 * @property string $city
 * @property AgePeriod $age_period
 * @property boolean $is_program
 * @property ProthesisLevel $prothesis_level
 * @property ProthesisFunction $prothesis_function
 * @property ?string $questions
 * @property ProposalStatus $status
 */

class ProposalProthesis extends Model
{

    protected $casts = [
        'prothesis_level'    => ProthesisLevel::class,
        'prothesis_function' => ProthesisFunction::class,
        'age_period'         => AgePeriod::class,
    ];
}


