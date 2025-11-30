<?php

namespace App\Models;

use App\Enum\ProposalStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property string $email
 * @property string $phone
 * @property string $organization
 * @property string $city
 * @property ?string $interest
 * @property ?string $questions
 * @property ProposalStatus $status
 */
class ProposalPrice extends Model
{
    use HasFactory;
}
