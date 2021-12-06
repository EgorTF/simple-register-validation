<?php
    function log_error($message) {
        $file = '../errors.log';
        $current = file_get_contents($file);
        $current .= date('Y-m-d H:i:s') . " " . $message . "\n";

        file_put_contents($file, $current);
    }

    $users_database = array(
        array('1', 'Алексей', 'foxconed@gmail.com'),
        array('2', 'Олег', 'blablabla@gmail.com'),
        array('3', 'Егор', 'somerandomuser@mail.ru')
    );

    $response_message = 'Вы успешно зарегистрированы!';
    $response_is_success = true;

    /**
     * @throws Exception если электронная почта указана неверно.
     */
    function validate_email($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception(
                'Электронная почта указана неверно (отсуствует символ @) (' .
                $email . 'FILTER_VALIDATE_EMAIL === false' . ')'
            );
        }
    }


    /**
     * @throws Exception если указанная электронная почта уже зарегистрирована.
     */
    function check_if_email_exists($email, $users_database) {
        $EMAIL_INDEX = 2;

        for ($row = 0; $row < count($users_database); ++$row) {
            $v = $users_database[$row][$EMAIL_INDEX];

            if ($v == $email) {
                throw new Exception('Данная электронная почта уже зарегистрирована! (' .
                    '$users' . '[' . $row . '][$EMAIL_INDEX] == ' . $v . ', $email == ' . $email .
                    ')'
                );
            }
        }
    }

    /**
     * @throws UnexpectedValueException если указанный пароль пуст.
     * @throws InvalidArgumentException если указанный пароль пуст не совпадает с $repeat_password.
     */
    function validate_password($password, $repeat_password) {
        if (empty($password)) {
            throw new UnexpectedValueException('Вы не ввели пароль! (passwd == "")');
        } elseif ($password != $repeat_password) {
            throw new InvalidArgumentException('Пароли не совпадают! "' . $password . '" != "' . $repeat_password . '"');
        }
    }

    try {
        if (!isset($_POST['email']) || !isset($_POST['password']))
            throw new Exception('Ошибка получения данных!');

        [
            'firstname'         => $username,
            'email'             => $email,
            'password'          => $password,
            'repeat-password'   => $repeat_password
        ] = $_POST;

        try {
            validate_email($email);
        } catch (Exception $e) {
            $response_message = 'Электронная почта указана неверно.';
            throw $e;
        }

        try {
            check_if_email_exists($email, $users_database);
        } catch (Exception $e) {
            $response_message = 'Данная электронная почта уже зарегистрирована!';
            throw $e;
        }

        try {
            validate_password($password, $repeat_password);
        } catch (UnexpectedValueException $e) {
            $response_message = 'Вы не ввели пароль!';
            throw $e;
        } catch (InvalidArgumentException $e) {
            $response_message = 'Пароли не совпадают!';
            throw $e;
        }
    } catch (Exception $e) {
        $response_is_success = false;
        log_error($e->getMessage());
    }

    echo json_encode(array(
        'success' => $response_is_success,
        'message' => $response_message
    ));
