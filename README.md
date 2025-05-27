# 🏋️‍♂️ OthrysFit

**OthrysFit** é uma plataforma web moderna de gestão de planos de treino e objetivos fitness, destinada a personal trainers e utilizadores. A aplicação permite o acompanhamento individualizado, interação via chat, visualização de progresso e organização de treinos personalizados.

---

## 📦 Funcionalidades

- Registo e login de utilizadores
- Inserção de dados pessoais (peso, altura, idade, etc.)
- Definição de objetivos
- Atribuição de planos de treino
- Dashboards separadas para Administrador e Utilizador
- Design moderno com Tailwind CSS
- Suporte a modo escuro

---

## 🛠️ Tecnologias e Ferramentas Usadas

- **Frontend**: HTML5, Tailwind CSS, JavaScript
- **Backend**: PHP
- **Base de Dados**: MySQL
- **Ambiente Local**: [XAMPP](https://www.apachefriends.org/index.html)
- **Gestão da Base de Dados**: [HeidiSQL](https://www.heidisql.com/)
- **Outros**:
  - Estrutura modular
  - Organização clara de ficheiros
  - Estilo responsivo

---

## 🚀 Instalação Local (Ambiente de Desenvolvimento)

### 1. Instalar XAMPP

- Faça o download e instale o XAMPP: [https://www.apachefriends.org](https://www.apachefriends.org)
- Inicie os módulos **Apache** e **MySQL** no painel de controlo do XAMPP.

### 2. Instalar HeidiSQL (opcional, recomendado)

- [Download HeidiSQL](https://www.heidisql.com/download.php)
- Configure uma nova sessão com:
  - **Host**: 127.0.0.1
  - **User**: root
  - **Password**: *(deixe em branco, por padrão)*
  - **Port**: 3306

### 3. Configurar o Projeto

#### a. Extrair o Projeto

- Extraia o conteúdo de `htdocs.zip` para o diretório:
  ```
  C:\xampp\htdocs\othrysfit
  ```

#### b. Criar a Base de Dados

1. Acesse o [phpMyAdmin](http://localhost/phpmyadmin) ou use o HeidiSQL.
2. Crie uma nova base de dados chamada:
   ```
   othrysfit
   ```
3. Importe o ficheiro `.sql` se estiver disponível (ex: `othrysfit.sql`).

#### c. Verificar as Credenciais de Ligação

Abra o ficheiro responsável pela conexão à base de dados (ex: `db.php`, `config.php`, ou similar) e confirme:

```php
$host = "localhost";
$user = "root";
$password = "";
$database = "othrysfit";
```

---

## 💻 Como Executar o Projeto

1. Inicie o XAMPP e ative **Apache** e **MySQL**.
2. No navegador, aceda a:
   ```
   http://localhost/othrysfit
   ```
3. Explore as funcionalidades de registo, login e gestão de treino.

---

## 📁 Estrutura Detalhada do Projeto

```
├── htdocs/
│   ├── index.html
│   ├── public/
│   │   ├── html/
│   │   │   ├── services.html
│   │   │   ├── admin/
│   │   │   │   ├── admin.html
│   │   │   ├── authentication/
│   │   │   │   ├── login.html
│   │   │   │   ├── register.html
│   │   │   │   ├── replacement.html
│   │   │   │   ├── user_data.html
│   │   │   ├── dashboard/
│   │   │   │   ├── dashboard.html
│   │   │   │   ├── objectives.html
│   │   │   │   ├── p_treino.html
│   │   ├── images/
│   │   │   ├── OthrysFit.ico
│   │   ├── js/
│   │   │   ├── theme-change.js
│   │   ├── webfonts/
│   │   │   ├── fa-brands-400.eot
│   │   │   ├── fa-brands-400.svg
│   │   │   ├── fa-brands-400.ttf
│   │   │   ├── fa-brands-400.woff
│   │   │   ├── fa-brands-400.woff2
│   │   │   ├── fa-regular-400.eot
│   │   │   ├── fa-regular-400.svg
│   │   │   ├── fa-regular-400.ttf
│   │   │   ├── fa-regular-400.woff
│   │   │   ├── fa-regular-400.woff2
│   │   │   ├── fa-solid-900.eot
│   │   │   ├── fa-solid-900.svg
│   │   │   ├── fa-solid-900.ttf
│   │   │   ├── fa-solid-900.woff
│   │   │   ├── fa-solid-900.woff2
│   ├── src/
│   │   ├── db/
│   │   │   ├── database.sql
│   │   ├── php/
│   │   │   ├── admin_dashboard_data.php
│   │   │   ├── dashboard_data.php
│   │   │   ├── db.php
│   │   │   ├── editar_usuario.php
│   │   │   ├── email_verify.php
│   │   │   ├── forgot_password.php
│   │   │   ├── get_treinos.php
│   │   │   ├── login.php
│   │   │   ├── logout.php
│   │   │   ├── marcar_objetivo_feito.php
│   │   │   ├── objectives_week.php
│   │   │   ├── promover_admin.php
│   │   │   ├── register.php
│   │   │   ├── remover_usuario.php
│   │   │   ├── reset_password.php
│   │   │   ├── save_user_data.php
│   │   │   ├── update_objective.php
```

---

## 🧑‍💼 Acesso de Teste (Opcional)

| Tipo de Utilizador | Email / Utilizador | Senha       |
|--------------------|--------------------|-------------|
| Administrador      | admin@example.com  | admin123    |
| Utilizador         | user@example.com   | user1234    |

---

## 🧑‍💻 Equipa de Desenvolvimento

- Desenvolvido por: Muck-Er
- Contacto: [stemspam530@gmail.com]

---

## 📄 Licença

Este projeto é Open Source e está licenciado sob a [MIT License](LICENSE).

---

## 📝 Notas Finais

- Certifique-se de que o Apache e MySQL estão ativos sempre que utilizar o sistema.
- Caso ocorram erros de base de dados, confirme o nome da BD, tabelas e credenciais no ficheiro de configuração.
- Recomenda-se o uso de **HeidiSQL** para facilitar a visualização e gestão da base de dados.
