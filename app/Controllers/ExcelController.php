<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\API\ResponseTrait;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as ReaderXlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelController extends BaseController
{
	use ResponseTrait;

	public function __construct()
	{
		$this->userModel = new User();
	}

	public function export()
	{
		$users = $this->userModel->withDeleted()->withDefault()->findAll();

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
		$filePath = 'uploads/users_'. time() .'.xlsx';
		$writer->save($filePath);

		download($filePath);
	}

	public function exportWithFilters()
	{
        $search = $this->request->getPost('search');
        $deleted = $this->request->getPost('deleted');
        $order_by = $this->request->getPost('order_by') ? $this->request->getPost('order_by') : 'created_at';
        $email_verified = $this->request->getPost('email_verified');

        $users = $this->userModel->withDefault()
								->withDeleted()
								->emailVerified($email_verified)
								->deleted($deleted)
								->search($search)
								->orderBy($order_by, 'ASC')
								->findAll();

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
		ob_start();
		$writer->save("php://output");
		$xlsData = ob_get_contents();
		ob_end_clean();

		$data =  array(
			'status' => 'success',
			'type' => 'application/vnd.ms-excel',
			'file' => base64_encode($xlsData),
			'filename' => 'users_'. time() .'.xlsx'
		);
		return $this->respond($data);
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

		$result = $this->validateExcelData($data);

		if (!$result['status']) {
			return $this->failValidationErrors($result['errors'], 422, 'Validation failed');
		}

		return $this->respond(array(
			'status' => 'success',
		));
	}

	public function validateExcelData($data)
	{
		$validation = \Config\Services::validation();

		$rules = array(
			'name' => 'required',
			'email' => 'required|valid_email',
			'phone' => 'required',
			'password' => 'required'
		);

		$errors = array();
		$headers = array_map('strtolower', $data[0]);
		unset($data[0]);
		$row = 2;
		foreach ($data as $key => $item) {
			$validation->reset();
			$validation->setRules($rules);

			$data = array_combine($headers, $item);
			if (!$validation->run($data)) {
				$error_list = $validation->getErrors();

				if (array_key_exists('name', $error_list)) {
					$errors[] = 'A'. $row .', '. $error_list['name'];
				}

				if (array_key_exists('email', $error_list)) {
					$errors[] = 'B'. $row .', '. $error_list['email'];
				}

				if (array_key_exists('phone', $error_list)) {
					$errors[] = 'C'. $row .', '. $error_list['phone'];
				}

				if (array_key_exists('password', $error_list)) {
					$errors[] = 'D'. $row .', '. $error_list['password'];
				}
			}

			$row++;
		}

		$result['status'] = true;

		if (count($errors)) {
			$result['status'] = false;
			$result['errors'] = $errors;
		}

		return $result;
	}
}