<?php
class Validator {
    public static function validateName($name) {
        $name = trim($name);
        return preg_match("/^[a-zA-Z\s'-]{1,255}$/", $name);
    }

    public static function validateEmail($email) {
        $email = trim($email);
        return preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email);
    }

    public static function validateDob($dob) {
        // Ensuring correct DOB format
        $date = DateTime::createFromFormat('Y-m-d', $dob);
        if (!$date || $date->format('Y-m-d') !== $dob) {
            error_log("Invalid date format for date of birth.");
            return false;
        }

        // Checking whether the date is in the future
        $currentDate = new DateTime();
        $dob = new DateTime($dob);
        if ($dob > $currentDate) {
            error_log("Date of birth cannot be in the future.");
            return false;
        }

        $day = (int) $dob->format('d');
        $month = (int) $dob->format('m');
        $year = (int) $dob->format('Y');

        // If month doesn't exist, error log it
        if ($month < 1 || $month > 12) {
            error_log("Invalid month in date of birth.");
            return false;
        }

        // Checking to ensure day in the month exists
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        if ($day < 1 || $day > $daysInMonth) {
            error_log("Invalid day for month.");
            return false;
        }

        // Minimum age check - currently set to 13
        $age = $dob->diff($currentDate)->y;
        if ($age < 13 || $age > 130) {
            error_log("Age is too low or high.");
            return false;
        }

        return true;
    }
}