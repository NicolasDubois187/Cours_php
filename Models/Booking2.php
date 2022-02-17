<?php 
declare(strict_types = 1);
class Booking {
  private Room $room;
  private Customer $customer;
  private Schedule $schedule;
  private string $date;
  private int $nb_player;
  private int $total_price;
  public function __construct(
    Room $p_room,
    Customer $p_customer,
    Schedule $p_schedule,
    string $p_date,
    int $p_nb_player,
    int $p_total_price
    )
    {
      $this->room = $p_room;
      $this->customer = $p_customer;
      $this->schedule = $p_schedule;
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
            ':room_id'      => $this->room_id,
            ':customer_id'  => $this->customer_id,
            ':schedule_id'  => $this->schedule_id, 
            ':date'         => $this->date,
            ':nb_player'    => $this->nb_player,
            ':total_price'  => $this->total_price,
            ]);
        return $result;
    }
    public function getRoom(): Room
    {
        return $this->room;
    }
  }
