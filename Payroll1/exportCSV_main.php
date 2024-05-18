<?php
require 'vendor/autoload.php'; // Include PhpSpreadsheet library

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Database connection
$con = mysqli_connect("localhost", "root", "", "ems");

$currentMonth = date('F Y');

// Query to fetch data
$query = mysqli_query($con, "SELECT payroll_ss.*, emp.*, payroll_ban.*
FROM payroll_ss
LEFT JOIN emp ON payroll_ss.empname = emp.empname
LEFT JOIN payroll_ban ON payroll_ss.empname = payroll_ban.empname
WHERE payroll_ss.salarymonth = '$currentMonth'");
$cnt = 1;

if (mysqli_num_rows($query) > 0) {
    // Create a new Spreadsheet object
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
// Set text value
$sheet->setCellValue('A1', 'ANIKA STERILIS PRIVATE LIMITED | SALARY SHEET');

// Merge cells
$sheet->mergeCells('A1:AL1');

// Center text horizontally and vertically
$sheet->getStyle('A1:AL1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A1:AL1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

// Set font size to 20 and make text bold
$sheet->getStyle('A1')->getFont()->setSize(20);
$sheet->getStyle('A1')->getFont()->setBold(true);


// 2ND ROW
$sheet->setCellValue('A2', 'SALARY FOR THE MONTH OF MARCH 2024');

// Merge cells
$sheet->mergeCells('A2:AL2');

// Center text horizontally and vertically
$sheet->getStyle('A2:AL2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A2:AL2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
// Apply vertical center alignment to the entire 4th row
$sheet->getStyle('4')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

// Set row height to 30
$sheet->getRowDimension(2)->setRowHeight(30);

// Add fill color (yellow) to the merged cells
$styleArray = [
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => ['rgb' => 'FFFF00'],
    ],
];

// Apply bold font to the merged cells
$sheet->getStyle('A2:AL2')->applyFromArray($styleArray);
$sheet->getStyle('A2:AL2')->getFont()->setBold(true);


    // Set column widths
    $sheet->getColumnDimension('A')->setWidth(7);
    $sheet->getColumnDimension('B')->setWidth(10);
    $sheet->getColumnDimension('C')->setWidth(45);
    $sheet->getColumnDimension('D')->setWidth(40);
    $sheet->getColumnDimension('E')->setWidth(21);
    $sheet->getColumnDimension('F')->setWidth(36);
    $sheet->getColumnDimension('G')->setWidth(12);
    $sheet->getColumnDimension('H')->setWidth(12);
    $sheet->getColumnDimension('I')->setWidth(12);
    $sheet->getColumnDimension('J')->setWidth(18.5);
    $sheet->getColumnDimension('K')->setWidth(16.57);
    $sheet->getColumnDimension('L')->setWidth(14);
    $sheet->getColumnDimension('M')->setWidth(14);
    $sheet->getColumnDimension('N')->setWidth(12);
    $sheet->getColumnDimension('O')->setWidth(12);
    $sheet->getColumnDimension('P')->setWidth(14);
    $sheet->getColumnDimension('Q')->setWidth(14);
    $sheet->getColumnDimension('R')->setWidth(17);
    $sheet->getColumnDimension('S')->setWidth(15);
    $sheet->getColumnDimension('T')->setWidth(15);
    $sheet->getColumnDimension('U')->setWidth(15);
    $sheet->getColumnDimension('V')->setWidth(16);
    $sheet->getColumnDimension('W')->setWidth(16);
    $sheet->getColumnDimension('X')->setWidth(16);
    $sheet->getColumnDimension('Y')->setWidth(16);
    $sheet->getColumnDimension('Z')->setWidth(15);
    $sheet->getColumnDimension('AA')->setWidth(17);
    $sheet->getColumnDimension('AB')->setWidth(16);
    $sheet->getColumnDimension('AC')->setWidth(20);
    $sheet->getColumnDimension('AD')->setWidth(20);
    $sheet->getColumnDimension('AE')->setWidth(20);
    $sheet->getColumnDimension('AF')->setWidth(20);
    $sheet->getColumnDimension('AG')->setWidth(30);
    $sheet->getColumnDimension('AH')->setWidth(12);
    $sheet->getColumnDimension('AI')->setWidth(20);
    $sheet->getColumnDimension('AJ')->setWidth(30);
    $sheet->getColumnDimension('AK')->setWidth(25);
    $sheet->getColumnDimension('AL')->setWidth(20);

    // Set row heights
    $headerRowHeight = 60;
    $valueRowHeight = 30;
    $sheet->getRowDimension('1')->setRowHeight($headerRowHeight);

// Merge and center cells for EMPLOYEE DETAILS
// Merge cells
$sheet->mergeCells('A3:F3');

// Set text value
$sheet->setCellValue('A3', 'EMPLOYEE DETAILS');

// Center text horizontally and vertically
$sheet->getStyle('A3:F3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A3:F3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

// Set bold and increase font size
$sheet->getStyle('A3:F3')->getFont()->setBold(true);
$sheet->getStyle('A3:F3')->getFont()->setSize(10);

// Add fill color (orange) to the merged cells
$styleArray = [
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => ['rgb' => 'FFC000'], // Orange color
    ],
];

$sheet->getStyle('A3:F3')->applyFromArray($styleArray);

$sheet->getRowDimension(3)->setRowHeight(40);

// Merge and center cells for FIXED SALARY COMPONENTS
$sheet->mergeCells('G3:J3');
$sheet->setCellValue('G3', 'FIXED SALARY COMPONENTS');
$sheet->getStyle('G3:J3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('G3:J3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
$sheet->getStyle('G3:J3')->getFont()->setBold(true);
$sheet->getStyle('G3:J3')->getFont()->setSize(10);
$sheet->getStyle('G3:J3')->applyFromArray([
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => ['rgb' => '92D050'], // Blue color
    ],
]);

// Merge and center cells for DAYS CALCULATION
$sheet->mergeCells('K3:O3');
$sheet->setCellValue('K3', 'DAYS CALCULATION');
$sheet->getStyle('K3:O3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('K3:O3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
$sheet->getStyle('K3:O3')->getFont()->setBold(true);
$sheet->getStyle('K3:O3')->getFont()->setSize(10);
$sheet->getStyle('K3:O3')->applyFromArray([
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => ['rgb' => 'F4B084'], // Black color
    ],
]);

// Merge and center cells for SALARY AS PER NO OF DAYS
$sheet->mergeCells('P3:S3');
$sheet->setCellValue('P3', 'SALARY AS PER NO OF DAYS');
$sheet->getStyle('P3:S3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('P3:S3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
$sheet->getStyle('P3:S3')->getFont()->setBold(true);
$sheet->getStyle('P3:S3')->getFont()->setSize(10);
$sheet->getStyle('P3:S3')->applyFromArray([
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => ['rgb' => 'BDD7EE'], // Pink color
    ],
]);

// Merge and center cells for DEDUCTION
$sheet->mergeCells('T3:Z3');
$sheet->setCellValue('T3', 'DEDUCTION');
$sheet->getStyle('T3:Z3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('T3:Z3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
$sheet->getStyle('T3:Z3')->getFont()->setBold(true);
$sheet->getStyle('T3:Z3')->getFont()->setSize(10);
$sheet->getStyle('T3:Z3')->applyFromArray([
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => ['rgb' => '00B0F0'], // Green color
    ],
]);

// Merge and center cells for BANK TRANSFER DETAILS
$sheet->mergeCells('AA3:AD3');
$sheet->setCellValue('AA3', 'BANK TRANSFER DETAILS');
$sheet->getStyle('AA3:AD3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('AA3:AD3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
$sheet->getStyle('AA3:AD3')->getFont()->setBold(true);
$sheet->getStyle('AA3:AD3')->getFont()->setSize(10);
$sheet->getStyle('AA3:AD3')->applyFromArray([
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => ['rgb' => 'FFC000'], // Peach color
    ],
]);

// Merge and center cells for OTHER DETAILS
$sheet->mergeCells('AE3:AL3');
$sheet->setCellValue('AE3', 'OTHER DETAILS');
$sheet->getStyle('AE3:AL3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('AE3:AL3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
$sheet->getStyle('AE3:AL3')->getFont()->setBold(true);
$sheet->getStyle('AE3:AL3')->getFont()->setSize(10);
$sheet->getStyle('AE3:AL3')->applyFromArray([
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => ['rgb' => 'A9D08E'], // Navy blue color
    ],
]);

$highlightedCells = ['B4', 'C4', 'D4', 'E4', 'F4']; // Specify the cells to highlight

// Apply fill color to the specified cells
foreach ($highlightedCells as $cell) {
    $sheet->getStyle($cell)->applyFromArray([
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => 'FFC000'], // Orange color
        ],
    ]);
}

// Merge the existing headers with the new headers
$headers = [
    'A4' => 'Sr No.',
    'B4' => 'TRAN ID',
    'C4' => 'EMPLOYEE NAME',
    'D4' => 'FATHER NAME',
    'E4' => 'DEPARTMENT',
    'F4' => 'DESIGNATION',
    'G4' => 'BASIC SALARY',
    'H4' => 'HRA',
    'I4' => 'OTHER ALLOWANCE',
    'J4' => 'GROSS SALARY',
    'K4' => 'TOTAL NO. OF DAYS',
    'L4' => 'PRESENT DAYS',
    'M4' => 'WEEK OFF DAYS',
    'N4' => 'ABSENT DAYS',
    'O4' => 'PAY DAYS',
    'P4' => 'BASIC SALARY',
    'Q4' => 'HRA',
    'R4' => 'OTHER ALLOWANCE',
    'S4' => 'GROSS SALARY',
    'T4' => 'EPF',
    'U4' => 'ESIC',
    'V4' => 'TDS',
    'W4' => 'ADVANCE SALARY',
    'X4' => 'LABOUR AND WELFARE FUND',
    'Y4' => 'LOAN & MISC',
    'Z4' => 'TOTAL DEDUCTION',
    'AA4' => 'SALARY PAYOUT',
    'AB4' => 'BENEFICIARY IFSC',
    'AC4' => 'BENEFICIARY ACCOUNT TYPE',
    'AD4' => 'BENEFICIARY ACCOUNT NO',
    'AE4' => 'SENDER ACCOUNT TYPE',
    'AF4' => 'SENDER ACCOUNT NO',
    'AG4' => 'SENDER NAME',
    'AH4' => 'SMS EML',
    'AI4' => 'DETAIL',
    'AJ4' => 'OoR7002 (SENDER NAME)',
    'AK4' => 'SENDER TO RECEIVER INFORMATION',
    'AL4' => 'REMARKS'
];


    foreach ($headers as $cell => $text) {
        $sheet->setCellValue($cell, $text);
        $sheet->getStyle($cell)->getAlignment()->setWrapText(true); // Wrap text
        $sheet->getStyle($cell)->getFont()->setBold(true); // Set bold font
        $sheet->getStyle($cell)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); // Set center alignment
    }

    // Fetch data and populate the spreadsheet
    $row = 5; // Start from row 2
    while ($data = mysqli_fetch_assoc($query)) {
        $sheet->setCellValue('A' . $row, $cnt . '');
        $sheet->getStyle('A' . $row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('B' . $row, $data['transid']);
        // Add other cell values here...

        // Increment row count
        $row++;
        $cnt++;
    }

    // Apply borders to the entire sheet
    $highestRowWithData = $sheet->getHighestRow();
    $highestColumnWithData = $sheet->getHighestColumn();
    $rangeWithData = 'A2:' . $highestColumnWithData . $highestRowWithData;

    $styleArray = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'],
            ],
        ],
    ];

    $sheet->getStyle($rangeWithData)->applyFromArray($styleArray);

    // Redirect output to a client’s web browser (Xlsx)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="ICICI-NEFT-' . date('F Y') . '.xlsx"');
    header('Cache-Control: max-age=0');

    // Create a writer and output the spreadsheet
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}
?>
