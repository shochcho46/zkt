<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Modules\Admin\Models\Attendence;
use Modules\Admin\Models\Employee;

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

        $startDate = $this->request->filled('from_date') ? Carbon::parse($this->request->from_date)->startOfDay() : null;
        $endDate = $this->request->filled('to_date') ? Carbon::parse($this->request->to_date)->endOfDay() : null;

        if ($startDate && $endDate) {
            $query->whereBetween('timestamp', [$startDate, $endDate]);
        }

        if ($this->request->filled('employee_id')) {
            $query->where('employee_id', $this->request->employee_id);
            $employees = [Employee::find($this->request->employee_id)];
        } else {
            $employees = Employee::all();
        }

        $attendances = $query->get()->groupBy(function ($item) {
            return $item->employee_id . '_' . Carbon::parse($item->timestamp)->toDateString();
        });

        // Build all date range
        $dates = [];
        if ($startDate && $endDate) {
            $period = new \DatePeriod($startDate, new \DateInterval('P1D'), $endDate->copy()->addDay());
            foreach ($period as $date) {
                $dates[] = clone $date;
            }
        }

        $rows = [];
        foreach ($employees as $employee) {
            if (!$employee) continue;
            $empId = $employee->id;
            $empName = $employee->name ?? 'N/A';
            $empUserId = $employee->userid ?? null;
            foreach ($dates as $date) {
                $key = $empId . '_' . $date->format('Y-m-d');
                if (isset($attendances[$key])) {
                    $group = $attendances[$key];
                    $sorted = $group->sortBy('timestamp');
                    $first = $sorted->first();
                    $last = $sorted->last();
                    $inTime = $first->timestamp ? Carbon::parse($first->timestamp)->format('H:i:s') : null;
                    $outTime = $last->timestamp ? Carbon::parse($last->timestamp)->format('H:i:s') : null;
                    $rows[] = [
                        'employee_name' => $empName,
                        'employee_id' => $empUserId,
                        'date' => $date->format('Y-m-d'),
                        'day_name' => $date->format('l'),
                        'in_time' => $inTime ?: 'N/A',
                        'out_time' => $outTime ?: 'N/A',
                    ];
                } else {
                    $rows[] = [
                        'employee_name' => $empName,
                        'employee_id' => $empUserId,
                        'date' => $date->format('Y-m-d'),
                        'day_name' => $date->format('l'),
                        'in_time' => 'N/A',
                        'out_time' => 'N/A',
                    ];
                }
            }
        }
        return collect($rows);
    }

    public function headings(): array
    {
        return [
            'Employee Name',
            'Employee ID',
            'Date',
            'Day Name',
            'In Time',
            'Out Time',
        ];
    }
}
