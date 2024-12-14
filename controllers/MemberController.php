<?php

require_once 'models/Member.php';
require_once 'controllers/Controller.php';

class MemberController extends Controller
{
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Validasi input
                if (empty($_POST['username']) || empty($_POST['password'])) {
                    throw new Exception("Username dan password harus diisi!");
                }

                if (strlen($_POST['password']) < 6) {
                    throw new Exception("Password minimal 6 karakter!");
                }

                $result = Member::register([
                    'username' => $_POST['username'],
                    'password' => $_POST['password']
                ]);

                if ($result) {
                    // Redirect ke dashboard setelah register dan login otomatis
                    header("Location: index.php?page=member-dashboard&success=1");
                    return;
                }
            } catch (Exception $e) {
                $this->error = $e->getMessage();
            }
        }

        require 'views/member/register.php';
    }

    public function dashboard()
    {
        if (!isset($_SESSION['member_id'])) {
            header("Location: index.php?page=member-register");
            return;
        }

        $member = Member::findByUsername($_SESSION['username']);
        if (!$member) {
            header("Location: index.php?page=member-register");
            return;
        }

        $activeLoans = Loan::getActiveLoansByMember($member->id);
        require 'views/member/dashboard.php';
    }
} 