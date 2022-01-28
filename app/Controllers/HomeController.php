<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use Config\Services;

class HomeController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        return view('app/pages/index');
    }

    public function about()
    {
        return view('app/pages/about');
    }

    public function contact()
    {
        return view('app/pages/contact', array('validation' => $this->validation));
    }

    public function contactSubmit()
    {
        $rules = array(
			'name' => 'required',
			'email' => 'required|valid_email',
			'phone'  => 'required',
			'message' => 'required',
		);

		if (!$this->validate($rules)) {
			$data = array(
				'validation' => $this->validator
			);
			return redirect()->back()->withInput($data);

        } else {

			$email = \Config\Services::email();
			$email->setTo($this->request->getVar('email'));
			// $email->setCC('another@another-example.com');
			// $email->setBCC('them@their-example.com');	
			$email->setSubject('Enquiry from ' . getenv('app.name'));

			$view = Services::renderer();
			$view->setData(['data' => $this->request->getVar()]);
			$html = $view->render('emails/enquiry.php');

			$email->setMessage($html);

			if ($email->send()) {
				return redirect()->back()->with("success", "Form submitited successfully");
			}

			return redirect()->back()->with("error", "Form submission failed");
		}
    }

    public function showPost($slug)
    {
        return view('app/pages/post');
    }

    public function newsLetterSubscribe()
	{
		$rules = array(
			'email' => 'required|valid_email|is_unique[news_letter_subscribe.email]',
		);

		if (!$this->validate($rules)) {

			$data = array(
				'message' => 'Please provide valid information',
				'validation' => $this->validator->getErrors()
			);
			return $this->failValidationErrors($data, 422, 'Validation failed');

        } else {
			$requestData = array(
				'email' => $this->request->getVar('email'),
				'subscribed_at' => date('Y-m-d')
			);
			// $subscribeModel = new NewsLetterSubscribe();
			// $subscribeModel->insert($requestData);

			$email = \Config\Services::email();
			$email->setTo($this->request->getVar('email'));
			// $email->setCC('another@another-example.com');
			// $email->setBCC('them@their-example.com');	
			$email->setSubject('News letter subscribe');

			$view = Services::renderer();
			// $view->setData(['data' => $this->request->getVar()]);
			$html = $view->render('emails/news_letter_subscribe.php');

			$email->setMessage($html);
			$email->send();

			$data = array(
				'message' => 'Thank you! for subscribing to NewsLetter'
			);
			return $this->respond($data);
		}
	}
}
