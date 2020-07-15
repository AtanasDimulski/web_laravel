<?php

namespace App\Exports;

use App\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->created_at,
        ];
    }
/**
 * @return array
 */
    public function headings(): array
    {
        return [
            'id',
            'name',
            'email',
            'date_created',
        ];
    }

    /**
     * @return Builder
     */
    /**
     * @return Collection
     */
    public function collection()
    {
        return User::all();
    }
}
