# ✅ Testes Automatizados — Sistema de Reserva de Salas

Este pacote contém três tipos de testes desenvolvidos para o sistema de gerenciamento de reservas de salas, disponível em:

🔗 **Projeto Principal**: [github.com/rodrigoskv/reserva-salas](https://github.com/rodrigoskv/reserva-salas)

ALUNOS: RODRIGO MIGUEL TELES DOS SANTOS E LEANDRO BERTOCCHI
---

## 📦 Conteúdo

* `tests/Unit/ReservationModelTest.php`: Verifica se há conflito de horários entre reservas.
* `tests/Feature/CreateReservationTest.php`: Simula a criação de uma reserva por um usuário autenticado.
* `tests/Performance/StressReservationTest.php`: Executa reservas consecutivas para simular carga no sistema.

---

## 🚀 Como Executar os Testes

1. **Clone ou acesse o projeto principal**:

   ```bash
   git clone https://github.com/rodrigoskv/reserva-salas
   cd reserva-salas
   ```

2. **Instale as dependências** (caso ainda não tenha):

   ```bash
   composer install
   ```

3. **Copie os testes** deste pacote para dentro da pasta `/tests` do projeto.

4. **Execute os testes** com PHPUnit:

   ```bash
   php vendor/bin/phpunit
   ```

5. **Para rodar apenas o teste de carga**:

   ```bash
   php vendor/bin/phpunit --filter StressReservationTest
   ```

---

## 🎥 Apresentação do Projeto

O funcionamento completo do sistema, incluindo o módulo de reservas e o impacto da carga, pode ser visualizado no vídeo de apresentação:

📽️ *Link da apresentação em vídeo*: **\https://youtu.be/q59bmIf5Yco**

---

## 📌 Requisitos

* PHP 8.1+
* Composer
* CodeIgniter 4
* Banco de dados MySQL configurado

---


