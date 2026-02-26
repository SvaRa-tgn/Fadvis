<?php

namespace Database\Seeders;

use App\DTO\Admin\User\CreateUserDTO;
use App\Enum\MessengerType;
use App\Enum\UserRoles;
use App\Interfaces\IUserRepository;
use App\Mail\RegistrationMail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MasterUserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRepository = app(IUserRepository::class);

        if ($userRepository->findByRole(UserRoles::ADMIN)) {
            return;
        }

        $dto = new CreateUserDTO(
            role: UserRoles::MASTER,
            name: 'Виктор',
            surname: 'Фадеев',
            slug: Str::of('Фадеев' . ' ' . 'Виктор' . ' ' . 'Сергеевич')->slug('-'),
            email: 'mkrasnyh@yandex.ru',
            phone: '+79045020332',
            messenger: MessengerType::TELEGRAM->value,
            organization: 'ИП Фадеев Виктор Сергеевич',
            address: 'г. Таганрог, Поляковское шоссе, 16К',
            password: Str::password(length: 12),
            patronymic: 'Сергеевич',
            site: 'Fadvis.com',
            inn: '615422313758',
            ogrn: '320619600067011',
        );

        $user = $userRepository->create($dto);

        Mail::to($user->email)->send(new RegistrationMail($dto));
    }
}
