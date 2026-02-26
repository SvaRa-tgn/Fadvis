<?php

namespace App\Repositories;

use App\DTO\Admin\Color\CreateColorDTO;
use App\DTO\Admin\Color\UpdateColorDTO;
use App\Enum\Status;
use App\Interfaces\IColorRepository;
use App\Models\Color;
use Illuminate\Database\Eloquent\Collection;

class ColorRepository implements IColorRepository
{
    /**
     * @param CreateColorDTO $dto
     * @param array $image
     * @return Color
     */
    public function create(CreateColorDTO $dto, array $image): Color
    {
        $color = new Color();
        $color->name = $dto->name;
        $color->slug = $dto->slug;
        $color->article = $dto->article;
        $color->link = $image['url'];
        $color->path = $image['path'];
        $color->status = Status::ACTIVE;

        $color->save();

        return $color;
    }

    /**
     * @param UpdateColorDTO $dto
     * @param array|null $image
     * @return Color
     */
    public function update(UpdateColorDTO $dto, array $image = null): Color
    {
        $color = $dto->color;
        $color->name = $dto->name ?: $color->name;
        $color->slug = $dto->slug ?: $color->slug;
        $color->article = $dto->article ?: $color->article;
        $color->link = !empty($image) ? $image['url'] : $color->link;
        $color->path = !empty($image) ? $image['path'] : $color->path;
        $color->status = $dto->status ?: $color->status;

        $color->save();

        return $color;
    }

    /**
     * @param Status $catalogStatus
     * @return Collection
     */
    public function findByStatus(Status $catalogStatus): Collection
    {
        return Color::where('status', $catalogStatus->value)->get();
    }
}
