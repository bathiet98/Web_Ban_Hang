<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionExport implements FromCollection, WithHeadings
{

    private $transactions;
    public function __construct($transactions)
    {
        $this->transactions = $transactions;
    }

    public function collection()
    {
        $transactions = $this->transactions;
        $formartTransaction = [];
        foreach ($transactions as $item)
        {
            $formartTransaction[] = [
                'id'        => $item->id,
                'name'      => $item->tst_name,
                'total'     => number_format($item->tst_total_money,0,',','.'),
                'email'     => $item->tst_email,
                'address'   => $item->tst_address,
                'phone'     => $item->tst_phone,
                'status'    => $item->getStatus($item->tst_status)['name'],
                'type'      => $item->tst_user_id ? 'Thành viên' : 'Khách',
                'created_at'=> $item->created_at,
            ];

        }
        //dd($formartTransaction);
        return collect($formartTransaction);
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Total',
            'Email',
            'Address',
            'Phone',
            'Status',
            'Type',
            'Created_at',
            'Updated_at',
        ];
    }
}
