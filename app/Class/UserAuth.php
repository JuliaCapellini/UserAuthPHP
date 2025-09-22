<?php

class UserAuth
{
    private int $id;
    private string $name;
    private string $email;
    private string $password;

    public function __construct(int $id, string $name, string $email, string $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
    
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassWord(): string
    {
        return $this->password;
    }

    public function setPassWord(string $password): void
    {
        $this->password = $password;
    }

    public function validateEmailIsValid(string $email): bool
    {
        return filter_var($this->email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function validatePasswordIsStrong(string $senha): bool
    {
        $parameter = '/^(?=.*[A-Z])(?=.*\d).{8,}$/';
        return preg_match($parameter, $this->password) === 1;
    }

    public function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function registerUser(int $id, string $name, string $email, string $password): string 
    {
        if (!$this->validateEmailIsValid($email)) 
        {
            return "Email inválido";
        }
        
        if (!$this->validatePasswordIsStrong($password)) 
        {
            return "Senha deve ter pelo menos 8 caracteres, 1 maiúscula e 1 número";
        }
        
        $hashedPassword = $this->hashPassword($password);
        
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $hashedPassword;
        
        return "Usuário registrado com sucesso!";
    }

    public function loginUser(string $email, string $password): string
    {
        if ($email !== $this->email) 
        {
            return "Email não encontrado";
        }
        
        if (!password_verify($password, $this->password)) 
        {
            return "Senha incorreta";
        }
        
        return "Login realizado com sucesso!";
    }

}