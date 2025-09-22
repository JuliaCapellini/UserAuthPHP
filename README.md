# UserAuthPHP

## Participantes

Julia Capellini RA: 1994186

Gabriele Martinez RA: 1991045

## Como rodar o projeto

Para executar este projeto usando Docker:

```bash
docker-compose up -d
```

- O projeto estará disponível em: `http://localhost:8080`

Para executar este projeto usando XAMPP:

- Coloque os arquivos do projeto na pasta htdocs do XAMPP;
- Start em Apache;
- O projeto estará disponível em `http://localhost:8080`

## Estrutura do Projeto

```bash
├── apache_conf/    
├── app/
│   ├── Class/      
        ├── User.php
        ├── UserManager.php
        └── Validator.php
    ├── index.php   
├── .gitignore
├── Dockerfile
├── README.md
└── docker-compose.yml
```

## Classes e suas Estruturas

**User**
- Classe responsável pelo construct do usuário.

**UserManager**
- Classe responsável pelas funções de Cadastro, Login e Reset de Senha.

**Validator**

- Classe responsável pelas funções de validações de dados.

## Funcionalidades e regra de negócio

- Cadastro de usuário com validações de:
  - Nome (tamanho mínimo/máximo, caracteres permitidos)
  - E-mail (formato e tamanho)
  - Senha (tamanho 8–30, pelo menos 1 maiúscula e 1 número)
- Verificação de e-mail duplicado (não permite cadastro repetido)
- Hash seguro de senha (`password_hash`) e verificação com `password_verify`
- Login de usuário (valida e-mail e senha)
- Reset de senha (valida nova senha e atualiza hash)
- Logs de sucesso/erro via `Validator::logSucess`/`logError`
- Busca de usuário por e-mail (`getUserByEmail`)

## Casos de Uso

**Caso 1 — Cadastro válido**

Entrada: nome Maria Oliveira, email maria@email.com, senha Senha123.

Resultado esperado: usuário cadastrado com sucesso.

**Caso 2 — Cadastro com e-mail inválido**

Entrada: nome Pedro, email pedro@@email, senha Senha123.

Resultado esperado: mensagem de erro → “E-mail inválido”.

**Caso 3 — Tentativa de login com senha errada**

Entrada: email joao@email.com, senha Errada123.

Resultado esperado: mensagem de erro → “Credenciais inválidas”.

**Caso 4 — Reset de senha válido**

Entrada: id 1, nova senha NovaSenha1.

Resultado esperado: senha alterada com sucesso.

**Caso 5 — Cadastro de usuário com e-mail duplicado**

Entrada: email já existente no array.

Resultado esperado: mensagem de erro → “E-mail já está em uso”.

**Caso 6 — Cadastro válido com sucesso no login**

Entrada: email existente no array com senha correta.

Resultado esperado: usuário cadastrado com sucesso, login realizado com sucesso.