<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Modules\Admin\Models\Attendence;

class AttendanceExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Attendence::query();

    if ($this->request->filled('from_date') && $this->request->filled('to_date')) {
        $startDate = Carbon::parse($this->request->from_date)->startOfDay();
        $endDate = Carbon::parse($this->request->to_date)->endOfDay();
        $query->whereBetween('timestamp', [$startDate, $endDate]);
    }

    if ($this->request->filled('employee_id')) {
        $query->where('employee_id', $this->request->employee_id);
    }

    // Get data and group by employee and date
    $attendances = $query->get()->groupBy(function ($item) {
        return $item->employee_id . '_' . Carbon::parse($item->timestamp)->toDateString();
    });

    $result = $attendances->map(function ($group) {
        $sorted = $group->sortBy('timestamp');
        $first = $sorted->first();
        $last = $sorted->last();

        return [
            'employee_name' => $first->employee->name ?? 'N/A',
            'employee_id' => $first->employee->userid ?? null,
            'date' => Carbon::parse($first->timestamp)->toDateString(),
            'in_time' => Carbon::parse($first->timestamp)->format('H:i:s'),
            'out_time' => Carbon::parse($last->timestamp)->format('H:i:s'),
        ];
    });

    return $result->values(); // Reset keys
    }

    public function headings(): array
        {
        
            return [
                'Employee Name',
                'Employee ID',
                'Date',
                'In Time',
                'Out Time',
            ];
        }
}
