<?php

class Register
{  
    private int $id;
    private string $name;
    private string $email;
    private float $senha;

    public function __construct(int $id, string $name, string $email, float $senha)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->senha = $senha;
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

    public function getSenha(): float
    {
        return $this->senha;
    }

    public function setSenha(float $senha): void
    {
        $this->senha = $senha;
    }
    
}

?>
