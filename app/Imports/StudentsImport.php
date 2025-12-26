<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\StudentFee;
use App\Models\StudentDue;
use App\Models\ParentUser;
use App\Services\FeeCalculator;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class StudentsImport implements ToCollection
{
    protected int $instituteId;
    protected string $feeType;
    protected string $academicYear;
    protected string $startMonth;
    protected int $startYear;

    public function __construct(
        int $instituteId,
        string $feeType,
        string $academicYear,
        string $startMonth,
        int $startYear
    ) {
        $this->instituteId  = $instituteId;
        $this->feeType      = $feeType;
        $this->academicYear = $academicYear;
        $this->startMonth   = $startMonth;
        $this->startYear    = $startYear;
    }

    public function collection(Collection $rows)
    {
        unset($rows[0]); // remove header row

        foreach ($rows as $row) {

            if (empty($row[0]) || empty($row[6])) {
                continue; // skip invalid rows
            }

            /** ======================
             *  CREATE / GET PARENT
             ====================== */
            $parent = ParentUser::firstOrCreate(
                ['mobile' => $row[2]],
                [
                    'name'      => $row[1],
                    'is_active' => 'Y',
                ]
            );

            /** ======================
             *  CREATE STUDENT
             ====================== */
            $student = Student::create([
                'institute_id'  => $this->instituteId,
                'parent_id'     => $parent->id,
                'name'          => $row[0],
                'parent_name'   => $row[1],
                'mobile'        => $row[2],
                'roll_no'       => $row[3],
                'class'         => $row[4],
                'section'       => $row[5],
                'academic_year' => $this->academicYear,
                'is_active'     => 'Y',
            ]);

            /** ======================
             *  CALCULATE FEES
             ====================== */
            $baseFee = (float) $row[6];

            $fee = FeeCalculator::calculate($this->feeType, $baseFee);

            /** ======================
             *  SAVE FEES
             ====================== */
            StudentFee::create([
                'student_id'    => $student->id,
                'monthly_fee'   => $fee['monthly_fee'],
                'quarterly_fee' => $fee['quarterly_fee'],
                'annual_fee'    => $fee['annual_fee'],
                'is_active'     => 'Y',
            ]);

            /** ======================
             *  GENERATE MONTHLY DUES
             ====================== */
            $this->generateMonthlyDues($student, $fee['monthly_fee']);
        }
    }

    private function generateMonthlyDues(Student $student, float $monthlyFee): void
    {
        if ($monthlyFee <= 0) {
            return;
        }

        $months = [
            'January','February','March','April','May','June',
            'July','August','September','October','November','December'
        ];

        $startIndex = array_search($this->startMonth, $months);

        for ($i = 0; $i < 12; $i++) {

            $monthIndex = ($startIndex + $i) % 12;
            $year = $this->startYear + intdiv($startIndex + $i, 12);

            StudentDue::create([
                'student_id' => $student->id,
                'month'      => $months[$monthIndex],
                'year'       => $year,
                'amount'     => $monthlyFee,
                'status'     => 'UNPAID',
                'is_active'  => 'Y',
            ]);
        }
    }
}
