<?php


namespace App\Controllers;

use App\Models\Manage\ReportsModel;
use App\Models\ReportModel;
use App\Models\Manage\WasteModel;
use TCPDF;

use App\Models\ReportModel as ModelsReportModel;
use FontLib\Table\Type\head;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Controllers\BaseController;

class ReportGeneration extends BaseController
{
	public function __construct()
	{
		$this->ReportModel = new ReportModel();
		$this->ReportsModel = new ReportsModel();
	}
	public function index()
	{
		//

		$dataP = $this->ReportsModel->preparedByJo();
		$d =  json_encode($dataP);
		$e = json_decode($d, true);
		$namePjo1 =  $e[0]['lname'] . " " . $e[0]['suffix'] . ", " . $e[0]['fname'] . " " . $e[0]['mname'];
		$positionPjo1 = $e[0]['position'];
		$namePjo2 =  $e[1]['lname'] . " " . $e[1]['suffix'] . ", " . $e[1]['fname'] . " " . $e[1]['mname'];
		$positionPjo2 = $e[1]['position'];
	}
	public function DailyReport()
	{
		//	$this->request->getPost('user_email');

		//	$postData = $this->input->post();
		//	$select_waste = $this->request->getVar('select_waste');
		$rdValue = $this->request->getPost('allowNum');
		$select_waste = $this->request->getPost('select_waste');
		if ($this->request->getPost('submit') != NULL) {

			$data = array(
				'report' => $this->ReportModel->weeklyData($select_waste),
			);

			$dataP = $this->ReportsModel->preparedBy();
			$d =  json_encode($dataP);
			$e = json_decode($d, true);
			$nameP =  $e[0]['lname'] . " " . $e[0]['suffix'] . ", " . $e[0]['fname'] . " " . $e[0]['mname'];
			$positionP = $e[0]['position'];

			$dataA = $this->ReportsModel->approvedBy();
			$d =  json_encode($dataA);
			$e = json_decode($d, true);
			$nameA =  $e[0]['lname'] . " " . $e[0]['suffix'] . ", " . $e[0]['fname'] . " " . $e[0]['mname'];
			$positionA = $e[0]['position'];

			$dataN = $this->ReportsModel->notedBy();
			$d =  json_encode($dataN);
			$e = json_decode($d, true);
			$nameN =  $e[0]['lname'] . " " . $e[0]['suffix'] . ", " . $e[0]['fname'] . " " . $e[0]['mname'];
			$positionN = $e[0]['position'];



			if ($rdValue == 0) {


				$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				$pdf->AddPage('P', 'A4');
				$pdf->setFont('Times', '', 9);
				$pdf->Cell(0, 0, "City Government of Dagupan", 0, 1, 'C');
				$pdf->setFont('Times', '', 11);
				$pdf->Cell(0, 0, "Waste Management Division", 0, 1, 'C');
				// print a block of text using Write()
				$pdf->ln();
				$pdf->ln(2);
				$pdf->SetTextColor(211, 211, 211);
				$pdf->setFont('Helvetica', 'B', 15);
				$pdf->Cell(0, 0, "Barangay Daily Waste Generated", 0, 1, 'C');
				$pdf->Cell(0, 0, $select_waste, 0, 1, 'C');
				$pdf->ln();
				$pdf->ln(2);
				$pdf->SetTextColor(0, 0, 0);
				$pdf->setFont('Times', '', 9);
				$pdf->Cell(0, 0, "For the month of " . date('M Y'), 0, 1, 'L');


				$html = view('admin/report/v_printpdf', $data);

				$pdf->writeHTML($html);

				$pdf->SetXY(10, 250);
				$pdf->Cell(0, 0, "Prepared By:", 0, 1, 'L');
				$pdf->SetXY(10, 260);
				$pdf->setFont('Times', 'B', 9);
				$pdf->Cell(0, 0, strtoupper($nameP), 0, 1, 'L');
				$pdf->SetXY(10, 265);
				$pdf->setFont('Times', '', 9);
				$pdf->Cell(0, 0, $positionP, 0, 1, 'L');

				$pdf->SetXY(90, 250);
				$pdf->Cell(0, 0, "Approved By:", 0, 1, 'L');
				$pdf->SetXY(90, 260);
				$pdf->setFont('Times', 'B', 9);
				$pdf->Cell(0, 0, strtoupper($nameA), 0, 1, 'L');
				$pdf->SetXY(90, 265);
				$pdf->setFont('Times', '', 9);
				$pdf->Cell(0, 0, $positionA, 0, 1, 'L');

				$pdf->SetXY(150, 250);
				$pdf->Cell(0, 0, "Noted By:", 0, 1, 'L');
				$pdf->SetXY(150, 260);
				$pdf->setFont('Times', 'B', 9);
				$pdf->Cell(0, 0, strtoupper($nameN), 0, 1, 'L');
				$pdf->SetXY(150, 265);
				$pdf->setFont('Times', '', 9);
				$pdf->Cell(0, 0, $positionN, 0, 1, 'L');

				$this->response->setContentType('application/pdf');



				$pdf->Output('Dailypdf', 'I');
			} elseif ($rdValue == 1) {
				$data = array(
					'report' => $this->ReportModel->monthlyData($select_waste),
				);
				$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				$pdf->SetMargins(20, 20, 20, true);
				$pdf->AddPage();
				$pdf->setFont('Times', '', 9);
				$pdf->Cell(0, 0, "City Government of Dagupan", 0, 1, 'C');
				$pdf->setFont('Times', '', 11);
				$pdf->Cell(0, 0, "Waste Management Division", 0, 1, 'C');
				// print a block of text using Write()
				$pdf->ln();
				$pdf->ln(2);
				$pdf->SetTextColor(211, 211, 211);
				$pdf->setFont('Helvetica', 'B', 15);
				$pdf->Cell(0, 0, "Barangay Monthly Waste Generated", 0, 1, 'C');
				$pdf->Cell(0, 0, $select_waste, 0, 1, 'C');
				$pdf->ln();
				$pdf->ln(2);
				$pdf->SetTextColor(0, 0, 0);
				$pdf->setFont('Times', '', 9);
				$pdf->Cell(0, 0, "For the month of " . date('M Y'), 0, 1, 'L');
				$pdf->SetMargins(50, 20, 50, true);
				$html = view('admin/report/monthly_report_b', $data);

				$pdf->writeHTML($html);

				$pdf->SetXY(10, 250);
				$pdf->Cell(0, 0, "Prepared By:", 0, 1, 'L');
				$pdf->SetXY(10, 260);
				$pdf->setFont('Times', 'B', 9);
				$pdf->Cell(0, 0, strtoupper($nameP), 0, 1, 'L');
				$pdf->SetXY(10, 265);
				$pdf->setFont('Times', '', 9);
				$pdf->Cell(0, 0, $positionP, 0, 1, 'L');

				$pdf->SetXY(90, 250);
				$pdf->Cell(0, 0, "Approved By:", 0, 1, 'L');
				$pdf->SetXY(90, 260);
				$pdf->setFont('Times', 'B', 9);
				$pdf->Cell(0, 0, strtoupper($nameA), 0, 1, 'L');
				$pdf->SetXY(90, 265);
				$pdf->setFont('Times', '', 9);
				$pdf->Cell(0, 0, $positionA, 0, 1, 'L');

				$pdf->SetXY(150, 250);
				$pdf->Cell(0, 0, "Noted By:", 0, 1, 'L');
				$pdf->SetXY(150, 260);
				$pdf->setFont('Times', 'B', 9);
				$pdf->Cell(0, 0, strtoupper($nameN), 0, 1, 'L');
				$pdf->SetXY(150, 265);
				$pdf->setFont('Times', '', 9);
				$pdf->Cell(0, 0, $positionN, 0, 1, 'L');

				$this->response->setContentType('application/pdf');

				$pdf->Output('monthlypdf', 'I');
			} else if ($rdValue == 2) {
				$data = array(
					'report' => $this->ReportModel->DailyValidationSummaryReport($select_waste),
				);
				$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				$pdf->SetMargins(20, 20, 20, true);
				$pdf->AddPage();
				$pdf->setFont('Times', '', 9);
				$pdf->Cell(0, 0, "City Government of Dagupan", 0, 1, 'C');
				$pdf->setFont('Times', '', 11);
				$pdf->Cell(0, 0, "Waste Management Division", 0, 1, 'C');
				// print a block of text using Write()
				$pdf->ln();
				$pdf->ln(2);
				$pdf->SetTextColor(211, 211, 211);
				$pdf->setFont('Helvetica', 'B', 15);
				$pdf->Cell(0, 0, "Barangay Monthly Waste Generated", 0, 1, 'C');
				$pdf->Cell(0, 0, $select_waste, 0, 1, 'C');
				$pdf->ln();
				$pdf->ln(2);
				$pdf->SetTextColor(0, 0, 0);
				$pdf->setFont('Times', '', 9);
				$pdf->Cell(0, 0, "For the month of " . date('M Y'), 0, 1, 'L');
				$pdf->SetMargins(50, 20, 50, true);
				$html = view('admin/report/dailyValidationReportSummary', $data);

				$pdf->writeHTML($html);

				$pdf->SetXY(10, 250);
				$pdf->Cell(0, 0, "Prepared By:", 0, 1, 'L');
				$pdf->SetXY(10, 260);
				$pdf->setFont('Times', 'B', 9);
				$pdf->Cell(0, 0, strtoupper($nameP), 0, 1, 'L');
				$pdf->SetXY(10, 265);
				$pdf->setFont('Times', '', 9);
				$pdf->Cell(0, 0, $positionP, 0, 1, 'L');

				$pdf->SetXY(90, 250);
				$pdf->Cell(0, 0, "Approved By:", 0, 1, 'L');
				$pdf->SetXY(90, 260);
				$pdf->setFont('Times', 'B', 9);
				$pdf->Cell(0, 0, strtoupper($nameA), 0, 1, 'L');
				$pdf->SetXY(90, 265);
				$pdf->setFont('Times', '', 9);
				$pdf->Cell(0, 0, $positionA, 0, 1, 'L');

				$pdf->SetXY(150, 250);
				$pdf->Cell(0, 0, "Noted By:", 0, 1, 'L');
				$pdf->SetXY(150, 260);
				$pdf->setFont('Times', 'B', 9);
				$pdf->Cell(0, 0, strtoupper($nameN), 0, 1, 'L');
				$pdf->SetXY(150, 265);
				$pdf->setFont('Times', '', 9);
				$pdf->Cell(0, 0, $positionN, 0, 1, 'L');

				$this->response->setContentType('application/pdf');

				$pdf->Output('monthlypdf', 'I');
			} elseif ($rdValue == 3) {
				$data =  json_encode($this->ReportModel->monthlyDataExcel($select_waste));
				$array = json_decode($data, true);

				$filename = 'wmsreports.xlsx';
				$spreadsheet = new Spreadsheet();
				$alignment_center = \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER;
				//		$sheet = $spreadsheet->getActiveSheet();


				$sheet = $spreadsheet->getActiveSheet();
				$sheet->setCellValue('A2', 'City Government of Dagupan');
				$sheet->mergeCells('A2:O2');
				$spreadsheet->getActiveSheet()->getStyle("A2:O2")->getFont()->setSize(12);

				$sheet->getStyle('A2:O7')->applyFromArray(
					array(
						'font'  => array(
							'bold'  =>  true
						)
					)
				);

				$sheet = $spreadsheet->getActiveSheet();
				$sheet->setCellValue('A3', 'Waste Management Division');
				$sheet->mergeCells('A3:O3');
				$spreadsheet->getActiveSheet()->getStyle("A3:O3")->getFont()->setSize(16);

				$sheet = $spreadsheet->getActiveSheet();
				$sheet->setCellValue('A5', $select_waste);
				$sheet->mergeCells('A5:O5');
				$spreadsheet->getActiveSheet()->getStyle("A5:O5")->getFont()->setSize(15);

				$spreadsheet->getActiveSheet()->getStyle("A8:O8")->getFont()->setSize(12);
				$sheet = $spreadsheet->getActiveSheet();
				$sheet->setCellValue('D8', 'Day');
				$sheet = $spreadsheet->getActiveSheet();
				$sheet->mergeCells('D8:G8');
				$sheet->setCellValue('H8', 'Volume');
				$sheet = $spreadsheet->getActiveSheet();
				$sheet->mergeCells('H8:L8');
				/*	$sheet->setCellValue('G7', 'waste_type');
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->mergeCells('G7:I7');
		$sheet->setCellValue('J7', 'volume');
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->mergeCells('J7:L7');
		$sheet->setCellValue('M7', 'Date');
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->mergeCells('M7:O7'); */
				$counterSumVol = 0;
				$count = 9;

				foreach ($array as $value) {
					$spreadsheet->getActiveSheet()->getStyle('C' . $count . ':' . 'O' . $count)->getFont()->setSize(12);
					$sheet->setCellValue('D' . $count, date("d", strtotime($value['date_c'])));
					$sheet = $spreadsheet->getActiveSheet();
					$sheet->mergeCells('D' . $count . ':' . 'G' . $count);
					$sheet->setCellValue('H' . $count, $value['sumVol']);
					$counterSumVol = $counterSumVol + $value['sumVol'];
					$sheet = $spreadsheet->getActiveSheet();
					$sheet->mergeCells('H' . $count . ':' . 'L' . $count);

					$count++;
				}
				$sheet->getStyle('D' . $count . ':' . 'L' . $count)->applyFromArray(
					array(
						'font'  => array(
							'bold'  =>  true
						)
					)
				);


				$sheet->setCellValue('D' . $count, "Total");
				$sheet = $spreadsheet->getActiveSheet();
				$sheet->mergeCells('D' . $count . ':' . 'G' . $count);

				$sheet->setCellValue('H' . $count, $counterSumVol);
				$sheet = $spreadsheet->getActiveSheet();
				$sheet->mergeCells('H' . $count . ':' . 'L' . $count);
				foreach ($sheet->getRowIterator() as $row) {
					foreach ($row->getCellIterator() as $cell) {
						$cellCoordinate = $cell->getCoordinate();
						$sheet->getStyle($cellCoordinate)->getAlignment()->setHorizontal($alignment_center);
					}
				}
				$writer = new Xlsx($spreadsheet);

				$writer->save($filename);

				header("Content-Type: application/vnd.ms-excel");
				header("Content-Disposition:attachment;filename=" . $filename . "");
				header('Expires: 0');
				header('Cache-Control: must-revalidate');
				header('Pragma: public');
				header('Content-Length: ' . filesize($filename));

				flush();

				readfile($filename);

				exit();
			}
		} else {
			return view('administrator/generate_report');
		}
	}
}
