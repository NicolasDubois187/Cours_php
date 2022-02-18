<?php

declare(strict_types=1);



class Customer
{
  private int $id;
  private string $firstname;
  private string $lastname;
  private string $email;

  public function __construct(
    string $p_firstname,
    string $p_lastname,
    string $p_email
  ) {
    $this->firstname = ucfirst(strtolower($p_firstname));
    $this->lastname = ucfirst(strtolower($p_lastname));
    $this->email = $p_email;
  }
  public function getId(): int
  {
    return $this->id;
  }

  public function setId(int $value): void
  {
    $this->id = $value;
  }
  public function getFirstname(): string
  {
    return ucfirst(strtolower($this->firstname));
  }
  public function getLastname(): string
  {
    return ucfirst(strtolower($this->lastname));
  }
  public function setLastname(string $lastname)
  {
    $this->lastname = $lastname;
  }
  public function setFirstname(string $firstname)
  {
    $this->firstname = $firstname;
  }
  public function setEmail(string $email)
  {
    $this->email = $email;
  }

  public function getEmail(): string
  {
    return $this->email;
  }

  public function insert(): ?int
  {
    $conn = connect_to_mysql();

    $query = $conn->prepare('INSERT INTO customers (firstname, lastname, email) 
		          VALUES (:firstname, :lastname, :email);');
    $result = $query->execute([
      ':firstname' => $this->firstname,
      ':lastname'  => $this->lastname,
      ':email'     => $this->email,
    ]);
    if ($result) {
      $this->id = (int)$conn->lastInsertId();
      return $this->id;
    } else {
      return null;
    }
  }
  public function update(): bool
  {
    $conn = connect_to_mysql();

    $query = $conn->prepare(
      "UPDATE `customers` SET `firstname` = :firstname, `lastname` = :lastname, `email` = :email WHERE `customers`.`id` = :id;"
    );

    $result = $query->execute([
      ':lastname'     => $this->lastname,
      ':firstname'  => $this->firstname,
      ':email'  => $this->email,
      ':id'  => $this->id,

    ]);

    return $result;
  }
  public function delete(): bool
  {
    $conn = connect_to_mysql();

    $query = $conn->prepare(
      "DELETE FROM `customers` WHERE `customers`.`id` = :id;"
    );

    $result = $query->execute([
      ':id' => $this->id,

    ]);

    return $result;
  }
}
