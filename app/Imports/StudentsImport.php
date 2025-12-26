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
                continue;
            }

            // PARENT
            $parent = ParentUser::firstOrCreate(
                ['mobile' => $row[2]],
                [
                    'name'      => $row[1],
                    'is_active' => 'Y',
                ]
            );

            // STUDENT
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

            // BASE FEE
            $baseFee = (float) $row[6];

            // CALCULATED
            $fee = FeeCalculator::calculate($this->feeType, $baseFee);

            // SAVE FEES
            StudentFee::create([
                'student_id'    => $student->id,
                'monthly_fee'   => $fee['monthly_fee'],
                'quarterly_fee' => $fee['quarterly_fee'],
                'annual_fee'    => $fee['annual_fee'],
                'is_active'     => 'Y',
            ]);

            // NEW LOGIC — GENERATE FEES
            $this->generateDues(
                $student,
                $this->feeType,
                $baseFee,
                $this->academicYear
            );
        }
    }

    /**
     * Generate dues based on plan
     */
    private function generateDues(Student $student, string $feeType, float $baseFee, string $academicYear)
    {
        [$startYear, $endYear] = explode('-', $academicYear);

        $months = [
            'April','May','June',
            'July','August','September',
            'October','November','December',
            'January','February','March'
        ];

        // MONTHLY
        if ($feeType === 'MONTHLY') {
            foreach ($months as $month) {
                $year = in_array($month, ['January','February','March'])
                    ? $endYear
                    : $startYear;

                StudentDue::create([
                    'student_id' => $student->id,
                    'month'      => $month,
                    'year'       => $year,
                    'amount'     => $baseFee,
                    'status'     => 'UNPAID',
                ]);
            }
        }

        // QUARTERLY
        if ($feeType === 'QUARTERLY') {

            $quarters = [
                ['April','May','June'],
                ['July','August','September'],
                ['October','November','December'],
                ['January','February','March'],
            ];

            foreach ($quarters as $q) {

                $year = in_array('January', $q) ? $endYear : $startYear;

                StudentDue::create([
                    'student_id' => $student->id,
                    'month'      => implode('-', $q),
                    'year'       => $year,
                    'amount'     => $baseFee,
                    'status'     => 'UNPAID',
                ]);
            }
        }

        // ANNUAL
        if ($feeType === 'ANNUAL') {
            StudentDue::create([
                'student_id' => $student->id,
                'month'      => 'APRIL-MARCH',
                'year'       => $startYear,
                'amount'     => $baseFee,
                'status'     => 'UNPAID',
            ]);
        }

        // ADVANCE
        if ($feeType === 'ADVANCE') {
            StudentDue::create([
                'student_id' => $student->id,
                'month'      => 'ADVANCE',
                'year'       => $startYear,
                'amount'     => $baseFee,
                'status'     => 'UNPAID',
            ]);
        }
    }
}
