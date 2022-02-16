<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class AuthController extends BaseController
{
    function __construct()
    {
        $this->userModel = new User();
    }
    
    public function signUpView()
    {
        return view('auth/sign-up', array('validation' => $this->validation));
    }

    public function signUp()
    {
        $rules = array(
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'phone' => 'required|exact_length[10]|max_length[10]',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'matches[password]',
            'terms' => 'required'
        );

        $messages = array(
            'password_confirmation' => array(
                'matches' => 'The confirm password field does not match the password field.'
            )
        );

        if (!$this->validate($rules, $messages)) {
            $data = array(
                'validation' => $this->validator
            );
            return redirect()->back()->withInput($data);
        }

        $requestData = $this->request->getPost();
        $requestData['type'] = 0;
        $requestData['email_verified'] = 0;

        $userId = $this->userModel->insert($requestData);
        $requestData['token'] = base64_encode_url($requestData['email'] . 'split' . $userId);

        $data = array(
            'data' => $requestData,
            'email' => $this->request->getPost('email'),
            'subject' => 'Registration successful for ' . getenv('app.name'),
            'view' => 'emails/verify.php',
        );

        $status = sendEmail($data);

        if ($status) {
            return redirect()->back()->with("success", "Registration complete. Please verify your email to login.");
        }

        return redirect()->back()->with("error", "Some unknown error happened.");
    }

    public function signInView()
    {
        return view('auth/sign-in', array('validation' => $this->validation));
    }

    public function verifyEmail($token)
    {
        $params = explode('split', base64_decode_url($token));
        $status = $this->userModel->update($params[1], array('email_verified' => 1));

        if ($status) {
            return redirect()->to('sign-in')->with("success", "Your email has been verified, Now you can login.");
        }

        return redirect()->to('sign-in')->with("error", "Some unknown error happened.");
    }

    public function signIn()
    {
        $rules = array(
            'email' => 'required|valid_email|check_email_registered[email]',
            'password' => 'required|min_length[6]|validate_user[email, password]',
        );

        $errorMessages = array(
			'password' => array(
				'validate_user' => 'Email or Password is incorrect'
            ),
            'email' => array(
                'check_email_registered' => 'This email is not registered in our system'
            )
		);

        if (!$this->validate($rules, $errorMessages)) {
            $data = array(
                'validation' => $this->validator
            );
            return redirect()->back()->withInput($data);
        } else {
            $user = $this->userModel->where('email', $this->request->getVar('email'))->first();

            if ($user->email_verified == 1) {
                $this->setUserSession($user);
                return redirect()->to('/dashboard');
            }

            return redirect()->to('sign-in')->with("error", "Please verify your email, to login");
        }
    }

    private function setUserSession($user)
    {
        $data = array(
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'user_type' => $user->type,
            'isLoggedIn' => true,
        );

        session()->set($data);
        return true;
    }

    public function signOut()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    public function passwordForgotView()
    {
        return view('auth/password/email', array('validation' => $this->validation));
    }

    public function sendPasswordResetEmail()
    {
        $rules = array(
            'email' => 'required|valid_email|check_email_registered[email]',
        );

        $errorMessages = array(
            'email' => array(
                'check_email_registered' => 'This email is not registered in our system'
            )
		);

        if (!$this->validate($rules, $errorMessages)) {
            $data = array(
                'validation' => $this->validator
            );
            return redirect()->back()->withInput($data);
        } else {
            $requestData = $this->request->getPost();
            $requestData['token'] = base64_encode_url($requestData['email'] . 'split' . time());

            $data = array(
                'data' => $requestData,
                'email' => $this->request->getPost('email'),
                'subject' => 'Password Reset for ' . getenv('app.name'),
                'view' => 'emails/reset.php',
            );
    
            $status = sendEmail($data);
    
            if ($status) {
                return redirect()->back()->with("success", "Password reset link has been sent to your email.");
            }
    
            return redirect()->back()->with("error", "Some unknown error happened.");
        }
    }

    public function passwordResetView($encrypted)
    {
        $params = explode('split', base64_decode_url($encrypted));
        $user = $this->userModel->where('email', $params[0])->first();
        
        $data = array(
            'user' => $user,
            'token' => $encrypted,
            'validation' => $this->validation
        );
        
        return view('auth/password/reset', $data);
    }

    public function passwordReset()
    {

        $rules = array(
            'password' => 'required|min_length[6]',
            'confirm_password' => 'required|min_length[6]|matches[password]',
        );
        $messages = array(
            'confirm_password' => array(
                'required' => 'The confirm password field is required.',
                'matches' => 'The confirm password field does not match the password field.'
            ),
        );

        if (!$this->validate($rules, $messages)) {
            $data = array(
                'validation' => $this->validator
            );
            return redirect()->back()->withInput($data);
        }

        $params = explode('_', base64_decode_url($this->request->getPost('token')));
        $result = $this->userModel->set(['password' => $this->request->getPost('password')])->where('email', $params[0])->update();
        if ($result) {
            return redirect()->to('sign-in')->with("success", "Password reset successful, Sign in to continue");
        }

        return redirect()->back()->with("error", "Some unknown error happened.");
    }
}
 