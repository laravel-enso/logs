<?php

namespace LaravelEnso\LogManager\Classes;

use App\User;
use LaravelEnso\LogManager\LogReport;
use LaravelEnso\LogManager\Notifications\LogErrorsNotification;

class LogReporting
{
    private $laravelLog;
    private $laravelLogErrors;

    public function __construct()
    {
        $logReport = new LogReport();
        $this->laravelLog = $logReport->laravel_log;
        $this->laravelLogErrors = $this->getLaravelLogErrors();
    }

    /**
     * Looks at the log, and if there are new errors, sends notification emails to the users
     * whose emails are given in the 'reporting.php' configuration file.
     */
    public function checkLaravelLog()
    {
        if ($this->laravelLogErrors->count()) {
            $users = $this->getNotifiable(config('reporting.emails', []));

            foreach ($users as $user) {
                $user->notify(new LogErrorsNotification($this->laravelLogErrors));
            }
        }
    }

    public function getLaravelLogErrors()
    {
        $laravelLogErrors = collect();
        $logFileSize = \File::size(storage_path('logs/laravel.log'));

        if ($logFileSize > 8000000) {
            \File::put(storage_path('logs/laravel.log'), '');
            $laravelLogErrors->push('Laravel.log file size exceeded limit and was cleaned...'.$logFileSize.'bytes');

            $this->laravelLog->size = 0;
            $this->laravelLog->save();

            return $laravelLogErrors;
        }

        $log = \File::get(storage_path('logs/laravel.log'));

        if ($this->laravelLog->size === strlen($log)) {
            return $laravelLogErrors;
        }

        $laravelLogErrors = $this->extractErrorsFromLog($log);

        $this->laravelLog->size = strlen($log);
        $this->laravelLog->save();

        return $laravelLogErrors;
    }

    private function extractErrorsFromLog($log)
    {
        $log = substr($log, $this->laravelLog->size);
        $laravelLogErrors = collect();
        $errorStartPos = strpos($log, env('APP_ENV').'.ERROR');

        while ($errorStartPos !== false) {
            $errorTimestamp = substr($log, $errorStartPos - 22, 22);
            $errorEndPos = strpos($log, env('APP_ENV').'.ERROR', $errorStartPos + 1) !== false ?
                strpos($log, env('APP_ENV').'.ERROR', $errorStartPos + 1) - 22
                : false;

            $currentError = substr($log, $errorStartPos, $errorEndPos ? $errorEndPos - $errorStartPos : strlen($log));

            $errorExists = $laravelLogErrors->search(function ($error) use ($currentError) {
                return strpos($error, $currentError) !== false;
            });

            if (!$errorExists) {
                $laravelLogErrors->push($errorTimestamp.$currentError);
            }

            $log = substr($log, $this->laravelLog->size);

            $errorStartPos = $errorEndPos ? $errorEndPos + 22 : false;
        }

        return $laravelLogErrors;
    }

    private function getNotifiable($emailsList)
    {
        $users = User::whereIn('email', $emailsList)->get();

        return $users;
    }
}
