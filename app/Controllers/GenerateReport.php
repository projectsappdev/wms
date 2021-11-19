<?php

namespace App\Controllers;

use App\Models\ReportModel;
use App\Models\Manage\WasteModel;
use TCPDF;
use App\Controllers\BaseController;
use App\Models\ReportModel as ModelsReportModel;
use FontLib\Table\Type\head;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class GenerateReport extends BaseController
{

	public function __construct()
	{
		$this->ReportModel = new ReportModel();
	}
	public function viewJ()
	{

		function getWeekday($date)
		{
			return date('w', strtotime($date));
		}
		/*$monday = strtotime("last monday");
		$monday = date('w', $monday) == date('w') ? $monday + 7 * 86400 : $monday;

		$sunday = strtotime(date("Y-m-d", $monday) . " +6 days");

		$this_week_start = date("Y-m-d", $monday);
		$this_week_end = date("Y-m-d", $sunday);

			echo "Current week range from $this_week_start to $this_week_end "; */
		/*	$start = (date('D') != 'Mon') ? date('Y-m-d', strtotime('last Monday')) : date('Y-m-d');
		$finish = (date('D') != 'Sun') ? date('Y-m-d', strtotime('next Sunday')) : date('Y-m-d');

		$format = date('N', strtotime($start));
		$formatF = date('N', strtotime($finish));
		$ranges = range($format, $formatF);

		echo "Number is  $ranges[1]"; */
		/*	$select_data = $this->request->getVar('select_waste');
		$data = array(
			'report' => $this->ReportModel->weeklyData($select_data),
		);*/
		/*	$startTime = strtotime(date('Y-m-d'));
		$endTime = strtotime(date('Y-m-d'));

		// Loop between timestamps, 24 hours at a time
		for ($i = $startTime; $i <= $endTime; $i = $i + 86400) {
			$thisDate = date('Y-m-d', $i); // 2010-05-01, 2010-05-02, etc
			echo "         $thisDate";
		}*/

		$select_data = "Biodegradable";

		$data = json_encode($this->ReportModel->monthlyDataExcel($select_data));

		$arrays = json_decode($data, true);

		foreach ($arrays as $values) {
			echo $values['date_c'];
			echo $values['sumVol'];
		}
	}
	public function reportAdministrator()
	{
		$model = new WasteModel();
		$data = $model->findAll();

		return view('administrator/generate_report', ["data" => $data]);
	}
	public function index()
	{

		/*	$data = array(
			'report' => $this->ReportModel->allData(),
		);
		return view('admin/generate_report', $data); */
		$model = new WasteModel();
		$data = $model->findAll();

		return view('admin/report/generate_report', ["data" => $data]);
	}
	public function try()
	{
		helper(['form', 'url']);
		$select_waste = $this->request->getVar('select_waste');
		echo json_encode($select_waste);
	}
	public function printpdf()
	{
		//helper('form');
		$select_data = "Non-Biodegradable";
		$data = array(
			'report' => $this->ReportModel->weeklyData($select_data),
		);

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
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
		$pdf->Cell(0, 0, "Barangay Daily Waste Generated", 0, 1, 'C');
		$pdf->Cell(0, 0, "Non-Biodegradable", 0, 1, 'C');
		$pdf->ln();
		$pdf->ln(2);
		$pdf->SetTextColor(0, 0, 0);
		$pdf->setFont('Times', '', 9);
		$pdf->Cell(0, 0, "For the month of " . date('M Y'), 0, 1, 'L');
		$html = view('admin/report/v_printpdf', $data);
		$pdf->writeHTML($html);

		$this->response->setContentType('application/pdf');

		$pdf->Output('Non-Biodegredable-pdf', 'I');
	}
	public function printpdfBio()
	{
		//helper('form');

		date_default_timezone_set('Asia/Manila');
		$select_data = "Biodegradable";
		$data = array(
			'report' => $this->ReportModel->weeklyData($select_data),
		);

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

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
		$pdf->Cell(0, 0, "Barangay Daily Waste Generated", 0, 1, 'C');
		$pdf->Cell(0, 0, "Biodegradable", 0, 1, 'C');
		$pdf->ln();
		$pdf->ln(2);
		$pdf->SetTextColor(0, 0, 0);
		$pdf->setFont('Times', '', 9);
		//date_default_timezone_get('UTC');
		//	$date = new DateTime('now', new DateTimeZone('Asia/Manila'));
		$pdf->Cell(0, 0, "For the month of " . date("Y-m-d H:i:sa"), 0, 1, 'L');
		$html = view('admin/report/u_printpdf', $data);
		$pdf->writeHTML($html);

		$this->response->setContentType('application/pdf');

		$pdf->Output('Biodegrdable-pdf', 'I');
	}
	public function monthlyReport()
	{
		$select_data = "Biodegradable";
		$data = array(
			'report' => $this->ReportModel->monthlyData($select_data),
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
		$pdf->Cell(0, 0, "Biodegradable", 0, 1, 'C');
		$pdf->ln();
		$pdf->ln(2);
		$pdf->SetTextColor(0, 0, 0);
		$pdf->setFont('Times', '', 9);
		$pdf->Cell(0, 0, "For the month of " . date('M Y'), 0, 1, 'L');
		$pdf->SetMargins(50, 20, 50, true);
		$html = view('admin/report/monthly_report_b', $data);

		$pdf->writeHTML($html);

		$this->response->setContentType('application/pdf');

		$pdf->Output('Biodegrdable-monthlypdf', 'I');
	}


	public function excel_monthly()
	{

		$select_data = "Biodegradable";

		$data =  json_encode($this->ReportModel->monthlyDataExcel($select_data));
		$array = json_decode($data, true);




		$filename = 'biodata.xlsx';
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
		$sheet->setCellValue('A5', 'Biodegradable');
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
	public function excel_monthly_Now()
	{

		$select_data = "Non-Biodegradable";

		$data =  json_encode($this->ReportModel->monthlyDataExcel($select_data));
		$array = json_decode($data, true);




		$filename = 'nonbiodata.xlsx';
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
		$sheet->setCellValue('A5', 'Non-Biodegradable');
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
}
