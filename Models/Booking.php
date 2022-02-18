<?php

declare(strict_types=1);


class Booking
{
  private int $id;
  private int $room_id;
  private int $customer_id;
  private int $schedule_id;
  private string $date;
  private int $nb_player;
  private int $total_price;

  public function __construct(
    int $p_room_id,
    int $p_customer_id,
    int $p_schedule_id,
    string $p_date,
    int $p_nb_player,
    int $p_total_price
  ) {
    $this->room_id = $p_room_id;
    $this->customer_id = $p_customer_id;
    $this->schedule_id = $p_schedule_id;
    $this->date = $p_date;
    $this->nb_player = $p_nb_player;
    $this->total_price = $p_total_price;
  }

  public function insert(): bool
  {
    $conn = connect_to_mysql();

    $query = $conn->prepare('INSERT INTO `booking` (`room_id`, `customer_id`, `schedule_id`, `date`, `nb_player`, `total_price`) 
								VALUES (:room_id, :customer_id, :schedule_id, :date, :nb_player, :total_price);');
    $result = $query->execute([
      ':room_id'     => $this->room_id,
      ':customer_id'  => $this->customer_id,
      ':schedule_id'  => $this->schedule_id,
      ':date'      => $this->date,
      ':nb_player'   => $this->nb_player,
      ':total_price'  => $this->total_price,
    ]);



    return $result;
  }
  public function setId(int $value): void
  {
    $this->id = $value;
  }
  public function getId(): int
  {
    return $this->id;
  }
  public function getRoomId(): int
  {
    return $this->room_id;
  }
  public function getCustomerId(): int
  {
    return $this->customer_id;
  }
  public function getDate(): string
  {
    return $this->date;
  }
  public function setDate(string $date)
  {
    $this->date = $date;
  }
  public function getSchedule_id(): int
  {
    return $this->schedule_id;
  }
  public function setScheduleId(int $schedule_id)
  {
    $this->schedule_id = $schedule_id;
  }
  public function getNbPlayer(): int
  {
    return $this->nb_player;
  }
  public function setNbPlayer(int $nb_player)
  {
    $this->nb_player = $nb_player;
  }
  public function getTotalPrice(): int
  {
    return $this->total_price;
  }
  public function setTotalPrice(int $total_price)
  {
    $this->total_price = $total_price;
  }
  public function update(): bool
  {
    $conn = connect_to_mysql();

    $query = $conn->prepare(
      "UPDATE `booking` SET `schedule_id` = :schedule_id, `date` = :date, `nb_player` = :nb_player, `total_price` = :total_price WHERE `booking`.`id` = :booking_id;"
    );

    $result = $query->execute([
      ':schedule_id'     => $this->schedule_id,
      ':date'  => $this->date,
      ':nb_player'  => $this->nb_player,
      ':total_price'  => $this->total_price,
      ':booking_id'  => $this->id,



    ]);

    return $result;
  }
}
