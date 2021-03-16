<?php


namespace Kl\Services;


use Kl\DbTables\UserDbTable;
use Kl\DbTables\UserPaymentDbTable;
use Kl\Models\User;
use Kl\Models\UserPayment;

/**
 * Class UserPaymentsService
 * @package Kl\Services
 */
class UserPaymentsService
{
    /**
     * @var UserPaymentDbTable;
     */
    private $userPaymentsDbTable;

    /**
     * @var UserDbTable;
     */
    private $userDbTable;

    /**
     * @return UserPaymentDbTable
     */
    public function getUserPaymentsDbTable(): UserPaymentDbTable
    {
        if (!$this->userPaymentsDbTable) {
            $this->userPaymentsDbTable = new UserPaymentDbTable();
        }

        return $this->userPaymentsDbTable;
    }

    /**
     * @return UserDbTable
     */
    public function getUserDbTable(): UserDbTable
    {
        if (!$this->userDbTable) {
            $this->userDbTable = new UserDbTable();
        }

        return $this->userDbTable;
    }

    /**
     * @param User $user
     * @param $amount
     * @return bool
     * @throws \Exception
     */
    public function changeBalance(User $user, $amount): bool
    {
        $userDbTable = $this->getUserDbTable();

        $userPaymentsDbTable = $this->getUserPaymentsDbTable();

        $paymentType = $amount >= 0 ? 'in' : 'out';

        $userBalance = $user->balance;

        $payment = new UserPayment($user->id, $paymentType, $userBalance, abs($amount));

        // add payment transaction
        if (!$userPaymentsDbTable->add($payment->toArray())) {
            $msg = sprintf('Failed to pop up user balance');

            error_log($msg);

            throw new \Exception($msg);
        }

        $user->balance += $amount;

        // send email
        $this->sendEmail($user->email);

        // update user balance in db
        $userDbTable->updateUser($user->toArray());

        return true;
    }

    /**
     * @param $userEmail
     * @return bool
     */
    public function sendEmail($userEmail): bool
    {
        $adminEmail = 'admin@test.com';

        $subject = 'Balance update';

        $message = 'Hello! Your balance has been successfully updated!';

        $headers = 'From: ' . $adminEmail . "\r\n" .
            'Reply-To: ' . $adminEmail . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($userEmail, $subject, $message, $headers);

        return true;
    }
}
