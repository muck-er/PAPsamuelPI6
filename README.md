# PAP Samuel - Plataforma de Planeamento de Treino

Este projeto foi desenvolvido como parte da Prova de Aptidão Profissional (PAP) e tem como objetivo principal disponibilizar uma plataforma simples e intuitiva para planeamento e acompanhamento de treinos personalizados.

## 🧠 Funcionalidades

- Registo e login de utilizadores
- Definição de objetivos de treino
- Planeamento semanal de treinos
- Dashboard com resumo de progresso
- Sistema de recuperação de palavra-passe
- Interface web responsiva

## 🗂 Estrutura do Projeto

PAPsamuelPI6/
├── public/                # Ficheiros acessíveis ao utilizador (HTML, CSS, JS, imagens)
│   ├── index.html
│   ├── css/
│   ├── js/
│   ├── images/
│   └── webfonts/
├── src/                   # Código backend em PHP
│   └── php/
│       ├── db.php
│       ├── login.php
│       ├── register.php
│       └── ...
├── docs/                  # Documentação e ficheiros auxiliares
│   └── objectives.md
├── README.md              # Este ficheiro

## ⚙️ Tecnologias Usadas

- HTML5, CSS3, JavaScript
- PHP
- Font Awesome
- Bootstrap (ou similar)
- MySQL (assumido, para ligação em `db.php`)

## 📦 Como Usar

1. Clona ou extrai este repositório
2. Coloca os ficheiros num servidor local (XAMPP, WAMP, etc.)
3. Cria a base de dados e importa a estrutura (ficheiro SQL não incluído)
4. Acede a `http://localhost/PAPsamuelPI6/public/login.html` no navegador

## 🧾 Notas

- Certifica-te de que o ficheiro `db.php` tem as credenciais corretas da tua base de dados.
- Alguns ficheiros PHP assumem a existência de sessões ativas (`session_start()`).
- O projeto pode ser facilmente adaptado para incluir novos tipos de treino ou funcionalidades.

## 📫 Contacto

Projeto desenvolvido por Samuel — 12º ano do Curso Profissional de Informática.

---

