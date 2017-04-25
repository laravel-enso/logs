<?php

namespace LaravelEnso\LogManager\app\Classes;

use LaravelEnso\LogManager\app\Notifications\ReportException;

class ErrorReporting
{
    private $exception;

    public function __construct(\Exception $exception)
    {
        $this->exception = $exception;
    }

    public function report()
    {
        $users = $this->getNotifiableUsers();

        foreach ($users as $user) {
            $user->notify(new ReportException($this->exception));
        }
    }

    private function getNotifiableUsers()
    {
        $emails = config('laravel-enso.reportingEmails', '');

        $users = config('auth.providers.users.model')
            ::whereIn('email', $emails)
            ->get();

        return $users;
    }
}
