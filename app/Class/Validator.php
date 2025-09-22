<?php

require_once "User.php";
require_once "UserManager.php";

class Validator
{
    private array $logs = [];

    private const NAME_MIN_LENGTH = 2;
    private const NAME_MAX_LENGTH = 100;
    private const EMAIL_MAX_LENGTH = 100;
    private const PASSWORD_MIN_LENGTH = 8;
    private const PASSWORD_MAX_LENGTH = 30;
    private const NAME_PATTERN = "/^[a-zA-ZÀ-ÿ'\-\s]+$/u";


    public function validateName(string $name): ?string
    {
        if (empty($name)) {
            $this->logError('Nome vazio');
            return 'Nome vazio';
        }
        if (strlen($name) < self::NAME_MIN_LENGTH) {
            $this->logError('Nome muito curto. ', $name);
            return 'Nome muito curto';
        }
        if (strlen($name) > self::NAME_MAX_LENGTH) {
            $this->logError('Nome muito longo. ', $name);
            return 'Nome muito longo';
        }
        if (!preg_match(self::NAME_PATTERN, $name)) {
            $this->logError('Nome com caracteres inválidos. ', $name);
            return 'Nome com caracteres inválidos';
        }
        return null;
    }

    public function validateEmail(string $email): ?string
    {
        if (empty($email)) {
            $this->logError('E-mail vazio fornecido');
            return 'E-mail vazio fornecido';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->logError('E-mail inválido. ', $email);
            return 'E-mail inválido';
        }
        if (strlen($email) > self::EMAIL_MAX_LENGTH) {
            $this->logError('E-mail muito longo. ', $email);
            return 'E-mail muito longo';
        }
        return null;
    }

    public function validatePassword(string $password): ?string
    {
        if (empty($password)) {
            $this->logError('Senha vazia');
            return 'Senha vazia';
        }
        if (strlen($password) < self::PASSWORD_MIN_LENGTH) {
            $this->logError('Senha muito curta. ', $password);
            return 'Senha muito curta';
        }
        if (strlen($password) > self::PASSWORD_MAX_LENGTH) {
            $this->logError('Senha muito longa. ', $password);
            return 'Senha muito longa';
        }
        if (!preg_match('/[A-Z]/', $password)) {
            $this->logError('A senha deve conter pelo menos uma letra maiúscula. ', $password);
            return 'A senha deve conter pelo menos uma letra maiúscula';
        }
        if (!preg_match('/[0-9]/', $password)) {
            $this->logError('A senha deve conter pelo menos um número. ', $password);
            return 'A senha deve conter pelo menos um número';
        }
        return null;
    }

    public function emailExists(string $email, array $users): ?string
    {
        $emailExists = false;
        foreach ($users as $user) {
           if ($user->getEmail() === $email) {
               $emailExists = true;
               break;
           }
        }

        if ($emailExists) {
            $this->logError('E-mail já existe. ', $email);
            return "Email já em uso.";
        }

        return null;
    }

    public function verifyPassword(string $password, string $hash): bool
    {
        if (password_verify($password, $hash)) {
            $this->logSucess('Senha válida');
            return true;
        }
        $this->logError('Senha inválida');
        return false;
    }

    public function logError(string $message, string $context = ""): string
    {
        $logMessage = date('Y-m-d H:i:s') . " - Erro: {$message}";
        if ($context) {
            $logMessage .= ": {$context}";
        }

        $this->logs[] = $logMessage;

        return $message;
    }

    public function logSucess(string $message, string $context = ""): string
    {
        $logMessage = date('Y-m-d H:i:s') . " - Sucesso: {$message}";
        if ($context) {
            $logMessage .= ": {$context}";
        }
        $this->logs[] = $logMessage;

        return $message;
    }

    public function getLogs(): array
    {
        return $this->logs;
    }
}
