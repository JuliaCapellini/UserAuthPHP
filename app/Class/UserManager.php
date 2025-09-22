<?php

require_once 'User.php';
require_once 'Validator.php';

class UserManager
{
    private array $users = [];
    private Validator $validator;

    public function __construct() {
        $this->validator = new Validator();
    }

    public function getUserByEmail(string $email): ?User
    {
        foreach ($this->users as $user) {
            if ($user->getEmail() === $email) {
                return $user;
            }
        }
        return null;
    }

    public function registerUser(User $user): string
    {
        $hasNameError = $this->validator->validateName($user->getName());
        if ($hasNameError) {
            return $hasNameError;
        }

        $hasEmailError = $this->validator->validateEmail($user->getEmail());
        if ($hasEmailError) {
            return $hasEmailError;
        }

        $hasPasswordError = $this->validator->validatePassword($user->getPassword());
        if ($hasPasswordError) {
            return $hasPasswordError;
        }
        
        $emailExists = $this->validator->emailExists($user->getEmail(), $this->users);
        if ($emailExists) {
            return $emailExists;
        }

        $this->users[] = $user;
        $this->validator->logSucess('Usuário Criado ', $user->getEmail());
        
        return "Usuário criado com sucesso!";
    }

    public function resetPassword(string $email, string $newPassword): string
    {
        $user = $this->getUserByEmail($email);
        if (!$user) {
            return "E-mail não encontrado";
        }

        $hasPasswordError = $this->validator->validatePassword($newPassword);
        if ($hasPasswordError) {
            return $hasPasswordError;
        }

        $user->setPassword($newPassword);
        $this->validator->logSucess('Senha alterada com sucesso para o usuário ', $email);
        
        return "Senha alterada com sucesso!";
    }

    public function loginUser(string $email, string $password): string
    {
        $hasEmailError = $this->validator->validateEmail($email);
        if ($hasEmailError) {
            return $hasEmailError;
        }

        $user = $this->getUserByEmail($email);
        if (!$user) {
            return "E-mail não encontrado";
        }

        if (!password_verify($password, $user->getPasswordHash())) {
            return "Senha incorreta";
        }

        $this->validator->logSucess('Login realizado com sucesso', $email);
        return "Login realizado com sucesso!";
    }

    public function getLogs(): array
    {
        return $this->validator->getLogs();
    }
}