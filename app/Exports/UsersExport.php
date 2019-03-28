<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::all();
    }

    public function headings()
    {
        return [
            '#',
            'Name',
            'Avatar',
            'Phone',
            'Email',
            'Updated at',
            'Created at',
            'Roles'
        ];
    }
}
