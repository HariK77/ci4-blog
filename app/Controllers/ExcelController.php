<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelController extends BaseController
{
	protected $user;

	public function __construct()
	{
		$this->user = new User();
	}

	public function index()
	{
		$users = $this->user->paginate(10);
		$data = array(
			'validation' => $this->validation,
			'users' => $users,
			'pager' => $this->user->pager
		);
		return view('manage/excel/index', $data);
	}

	public function excelExport()
	{
		$users = $this->user->findAll();

		$spreadsheet = new Spreadsheet();

		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'Id');
		$sheet->setCellValue('B1', 'Name');
		$sheet->setCellValue('C1', 'Email');
		$sheet->setCellValue('D1', 'Created At');
		$sheet->setCellValue('E1', 'Updated At');

		$sheet->getColumnDimension('A')->setAutoSize(true);
		$sheet->getColumnDimension('B')->setAutoSize(true);
		$sheet->getColumnDimension('C')->setAutoSize(true);
		$sheet->getColumnDimension('D')->setAutoSize(true);
		$sheet->getColumnDimension('E')->setAutoSize(true);

		$rows = 2;
		foreach ($users as $user) {
			$sheet->setCellValue('A' . $rows, $user->id);
			$sheet->setCellValue('B' . $rows, $user->name);
			$sheet->setCellValue('C' . $rows, $user->email);
			$sheet->setCellValue('D' . $rows, formatDate($user->created_at));
			$sheet->setCellValue('E' . $rows, formatDate($user->updated_at));
			$rows++;
		}

		$writer = new Xlsx($spreadsheet);
		$filePath = 'uploads/users.xlsx';
		$writer->save($filePath);

		download($filePath);
	}

	public function excelImport()
	{
		$rules = array(
			'file' => 'uploaded[file]|max_size[file,2048]|ext_in[file,xlsx]'
		);

		if (!$this->validate($rules)) {
			$data = array(
				'validation' => $this->validator
			);
			return redirect()->back()->withInput($data);
		}

		$reader = new ReaderXlsx();
		$reader->setReadDataOnly(true);
		$spreadsheet = $reader->load($this->request->getFile('file'));
		$data = $spreadsheet->getActiveSheet()->toArray();

		dd($data);

	}

	public function validateExcelCoulmns($data)
	{
		
	}
}