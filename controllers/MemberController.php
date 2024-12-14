<?php

require_once 'models/Member.php';
require_once 'controllers/Controller.php';

class MemberController extends Controller
{
    public function register()
    {
        if (!$this->isLoggedIn()) {
            header("Location: index.php?page=login");
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $result = Member::register($_SESSION['user_id'], [
                    'nik' => $_POST['nik'],
                    'full_name' => $_POST['full_name'],
                    'address' => $_POST['address'],
                    'phone' => $_POST['phone']
                ]);

                if ($result) {
                    header("Location: index.php?page=member-dashboard");
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
        if (!$this->isLoggedIn()) {
            header("Location: index.php?page=login");
            return;
        }

        $member = Member::findByUserId($_SESSION['user_id']);
        if (!$member) {
            header("Location: index.php?page=member-register");
            return;
        }

        $activeLoans = Loan::getActiveLoansByMember($member->getId());
        require 'views/member/dashboard.php';
    }
} 