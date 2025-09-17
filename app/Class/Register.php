<?php

class User.php 
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

    
}


