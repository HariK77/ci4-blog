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

	public function export()
	{
		$users = $this->user->findAll();

		$spreadsheet = new Spreadsheet();

		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'Id');
		$sheet->setCellValue('B1', 'Name');
		$sheet->setCellValue('C1', 'Email');
		$sheet->setCellValue('D1', 'Phone');
		$sheet->setCellValue('E1', 'Email Verified');
		$sheet->setCellValue('F1', 'Created At');
		$sheet->setCellValue('G1', 'Updated At');
		$sheet->setCellValue('H1', 'Deleted At');

		$sheet->getColumnDimension('A')->setAutoSize(true);
		$sheet->getColumnDimension('B')->setAutoSize(true);
		$sheet->getColumnDimension('C')->setAutoSize(true);
		$sheet->getColumnDimension('D')->setAutoSize(true);
		$sheet->getColumnDimension('E')->setAutoSize(true);
		$sheet->getColumnDimension('F')->setAutoSize(true);
		$sheet->getColumnDimension('G')->setAutoSize(true);
		$sheet->getColumnDimension('H')->setAutoSize(true);

		$rows = 2;
		foreach ($users as $user) {
			$sheet->setCellValue('A' . $rows, $user->id);
			$sheet->setCellValue('B' . $rows, $user->name);
			$sheet->setCellValue('C' . $rows, $user->email);
			$sheet->setCellValue('D' . $rows, $user->phone);
			$sheet->setCellValue('E' . $rows, $user->email_verified ? 'verified' : 'non verified');
			$sheet->setCellValue('F' . $rows, formatDate($user->created_at, 1));
			$sheet->setCellValue('G' . $rows, formatDate($user->updated_at, 1));
			$sheet->setCellValue('H' . $rows, formatDate($user->deleted_at, 1));
			$rows++;
		}

		$writer = new Xlsx($spreadsheet);
		$filePath = 'uploads/users'. time() .'.xlsx';
		$writer->save($filePath);

		download($filePath);
	}

	public function import()
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
		$validation = \Config\Services::validation();

		$rules = array(
			'name' => 'required',
			'email' => 'required|valid_email',
			'password' => 'required'
		);

		$errors = array();

		$row = 2;
		foreach ($data as $key => $item) {
			$validation->reset();
			$validation->setRules($rules);

			if (!$validation->run($item)) {

				$errorMsg = '';
				$error_list = $validation->getErrors();

				if (array_key_exists('name', $error_list)) {
					$errorMsg = 'error on Row '. $row .' column A, '. $error_list['name'];
				}

				if (array_key_exists('email', $error_list)) {
					$errorMsg = 'error on Row '. $row .' column B, '. $error_list['email'];
				}

				if (array_key_exists('password', $error_list)) {
					$errorMsg = 'error on Row '. $row .' column C, '. $error_list['password'];
				}
				// $error_list['row'] = $row;
				$errors[] = $errorMsg;
			}

			$row++;
		}

		$data['status'] = 'success';

		if (count($errors)) {
			$data['status'] = 'error';
			$data['errors'] = $errors;
		}

		return $data;
	}
}